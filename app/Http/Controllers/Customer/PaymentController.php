<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\MidtransService;
use Illuminate\Http\RedirectResponse;
use Throwable;

class PaymentController extends Controller
{
    public function pay(Booking $booking, MidtransService $midtrans): RedirectResponse
    {
        // Pastikan booking milik user yang login
        abort_if((int) $booking->customer_id !== (int) auth()->id(), 403);

        // Pastikan payment record ada
        if (!$booking->payment) {
            return back()->with('error', 'Data pembayaran tidak ditemukan. Hubungi administrator.');
        }

        // Sudah dibayar
        if ($booking->payment->payment_status === 'paid') {
            return back()->with('info', 'Booking ini sudah dibayar.');
        }

        // Status booking dibatalkan
        if (in_array($booking->status_booking, ['cancelled', 'completed'])) {
            return back()->with('error', 'Booking ini tidak dapat dibayar karena sudah ' . $booking->status_booking . '.');
        }

        try {
            // Buat transaksi baru jika belum ada snap URL,
            // atau jika snap token sudah kadaluarsa (> 24 jam sejak dibuat)
            $needNewTransaction = !$booking->payment->snap_redirect_url
                || $this->isSnapExpired($booking->payment);

            if ($needNewTransaction) {
                $midtrans->createSnapTransaction($booking);
                $booking->refresh();
            }

            if (!$booking->payment->snap_redirect_url) {
                return back()->with('error', 'Gagal mendapatkan URL pembayaran. Silakan coba lagi.');
            }

            return redirect()->away($booking->payment->snap_redirect_url);

        } catch (\RuntimeException $e) {
            // Error konfigurasi atau validasi data (pesan aman untuk ditampilkan)
            return back()->with('error', $e->getMessage());

        } catch (Throwable $e) {
            // Error dari API Midtrans atau network
            $message = $this->parseMidtransError($e);
            report($e);

            return back()->with('error', $message);
        }
    }

    /**
     * Cek apakah snap token sudah kadaluarsa (> 23 jam untuk safety margin).
     */
    private function isSnapExpired(\App\Models\Payment $payment): bool
    {
        if (!$payment->updated_at) {
            return false;
        }

        return $payment->updated_at->diffInHours(now()) >= 23;
    }

    /**
     * Parse pesan error dari Midtrans menjadi pesan yang ramah untuk user.
     */
    private function parseMidtransError(Throwable $e): string
    {
        $raw = $e->getMessage();

        // Midtrans mengembalikan JSON error di dalam message
        $decoded = json_decode($raw, true);

        if (json_last_error() === JSON_ERROR_NONE && isset($decoded['error_messages'])) {
            $errors = (array) $decoded['error_messages'];
            return 'Pembayaran gagal: ' . implode(', ', $errors);
        }

        // Pesan umum berdasarkan HTTP status jika ada
        if (str_contains($raw, '401') || str_contains($raw, 'Unauthorized')) {
            return 'Konfigurasi pembayaran tidak valid. Hubungi administrator.';
        }

        if (str_contains($raw, '400') || str_contains($raw, 'Bad Request')) {
            return 'Data transaksi tidak valid. Silakan coba lagi atau hubungi administrator.';
        }

        if (str_contains($raw, '503') || str_contains($raw, 'Service Unavailable')
            || str_contains($raw, 'cURL') || str_contains($raw, 'Connection')) {
            return 'Layanan pembayaran sedang tidak tersedia. Silakan coba beberapa saat lagi.';
        }

        return 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.';
    }
}
