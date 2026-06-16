<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Traits\SendsNotificationSafely;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class MidtransWebhookController extends Controller
{
    use SendsNotificationSafely;
    public function __invoke(Request $request): Response
    {
        Log::info('Midtrans webhook received', $request->all());

        // ── Tangani ping test dari dashboard Midtrans ─────────────────────────
        if (str_starts_with((string) $request->order_id, 'payment_notif_test_')) {
            Log::info('Midtrans dashboard test notification received', [
                'order_id' => $request->order_id,
            ]);
            return response('OK - Midtrans test notification received', 200);
        }

        // ── Validasi field wajib ──────────────────────────────────────────────
        $required = ['order_id', 'status_code', 'gross_amount', 'signature_key'];
        foreach ($required as $field) {
            if (!$request->filled($field)) {
                Log::info('Midtrans webhook received incomplete payload', [
                    'missing_field' => $field,
                    'payload'       => $request->all(),
                ]);
                return response('OK - Midtrans webhook endpoint is active', 200);
            }
        }

        // ── Verifikasi signature ──────────────────────────────────────────────
        $serverKey = (string) config('midtrans.server_key');

        if (empty($serverKey)) {
            Log::error('Midtrans server key not configured', [
                'order_id' => $request->order_id,
            ]);
            return response('Server configuration error', 500);
        }

        $expectedSignature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if (!hash_equals($expectedSignature, (string) $request->signature_key)) {
            Log::warning('Invalid Midtrans signature', [
                'order_id'          => $request->order_id,
                'server_key_exists' => !empty($serverKey),
            ]);
            return response('Invalid signature', 403);
        }

        // ── Proses transaksi ──────────────────────────────────────────────────
        try {
            return DB::transaction(function () use ($request): Response {
                $payment = Payment::where('midtrans_order_id', $request->order_id)
                    ->lockForUpdate()
                    ->with('booking.customer')
                    ->first();

                if (!$payment) {
                    Log::warning('Payment not found for Midtrans order', [
                        'order_id' => $request->order_id,
                    ]);
                    // Tetap 200 agar Midtrans tidak retry terus-menerus
                    return response('Payment not found', 200);
                }

                $transactionStatus = (string) $request->transaction_status;
                $fraudStatus       = (string) ($request->fraud_status ?? '');

                [$paymentStatus, $bookingStatus] = $this->resolveStatuses(
                    $transactionStatus,
                    $fraudStatus
                );

                // Hindari update mundur (paid → pending tidak boleh terjadi)
                if ($payment->payment_status === 'paid' && $paymentStatus !== 'paid') {
                    Log::info('Midtrans webhook ignored: payment already paid', [
                        'order_id'           => $request->order_id,
                        'incoming_status'    => $transactionStatus,
                    ]);
                    return response('OK', 200);
                }

                $oldPaymentStatus = $payment->payment_status;

                $payment->update([
                    'payment_status'     => $paymentStatus,
                    'transaction_status' => $transactionStatus,
                    'fraud_status'       => $fraudStatus ?: null,
                    'payment_type'       => $request->payment_type,
                    'metode_pembayaran'  => $request->payment_type ?? 'midtrans',
                    'payment_date'       => $paymentStatus === 'paid' ? now() : $payment->payment_date,
                ]);

                $payment->booking->update([
                    'status_booking' => $bookingStatus,
                ]);

                // Kirim notifikasi hanya sekali ketika baru paid
                if ($paymentStatus === 'paid' && $oldPaymentStatus !== 'paid') {
                    $this->notifyCustomer($payment);
                }

                Log::info('Midtrans webhook processed', [
                    'order_id'       => $request->order_id,
                    'payment_status' => $paymentStatus,
                    'booking_status' => $bookingStatus,
                ]);

                return response('OK', 200);
            });

        } catch (Throwable $e) {
            Log::error('Midtrans webhook processing failed', [
                'order_id' => $request->order_id ?? null,
                'error'    => $e->getMessage(),
                'trace'    => $e->getTraceAsString(),
            ]);

            // Kembalikan 500 agar Midtrans mencoba ulang notifikasi
            return response('Internal server error', 500);
        }
    }

    /**
     * Tentukan payment_status dan booking_status berdasarkan respons Midtrans.
     *
     * @return array{0: string, 1: string} [$paymentStatus, $bookingStatus]
     */
    private function resolveStatuses(string $transactionStatus, string $fraudStatus): array
    {
        return match (true) {
            $transactionStatus === 'capture' && $fraudStatus === 'accept'
                => ['paid',     'paid'],

            $transactionStatus === 'capture' && $fraudStatus === 'challenge'
                => ['pending',  'pending'],

            $transactionStatus === 'settlement'
                => ['paid',     'paid'],

            $transactionStatus === 'pending'
                => ['pending',  'pending'],

            in_array($transactionStatus, ['cancel', 'deny', 'expire'], true)
                => ['failed',   'cancelled'],

            $transactionStatus === 'refund'
                => ['refunded', 'cancelled'],

            default
                => ['pending',  'pending'],
        };
    }

    private function notifyCustomer(Payment $payment): void
    {
        try {
            if (class_exists(\App\Notifications\PaymentSuccessNotification::class)) {
                $this->notifySafely(
                    $payment->booking->customer,
                    new \App\Notifications\PaymentSuccessNotification($payment)
                );
            }
        } catch (Throwable $e) {
            // Jangan gagalkan webhook hanya karena notifikasi bermasalah
            Log::warning('Failed to send payment success notification', [
                'payment_id' => $payment->payment_id,
                'error'      => $e->getMessage(),
            ]);
        }
    }
}
