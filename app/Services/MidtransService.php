<?php

namespace App\Services;

use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Snap;
use RuntimeException;

class MidtransService
{
    public function __construct()
    {
        $serverKey = trim((string) config('midtrans.server_key'));

        if (empty($serverKey)) {
            throw new RuntimeException(
                'Midtrans server key belum dikonfigurasi. Periksa MIDTRANS_SERVER_KEY di file .env.'
            );
        }

        Config::$serverKey    = $serverKey;
        Config::$isProduction = filter_var(config('midtrans.is_production'), FILTER_VALIDATE_BOOLEAN);
        Config::$isSanitized  = filter_var(config('midtrans.is_sanitized'), FILTER_VALIDATE_BOOLEAN);
        Config::$is3ds        = filter_var(config('midtrans.is_3ds'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Buat Snap transaction baru ke Midtrans.
     * Jika order_id sudah pernah dipakai, generate yang baru.
     */
    public function createSnapTransaction(Booking $booking): object
    {
        $booking->load([
            'customer',
            'salon',
            'details.service',
            'payment',
        ]);

        if (!$booking->payment) {
            throw new RuntimeException(
                'Data payment untuk booking #' . $booking->booking_id . ' tidak ditemukan.'
            );
        }

        if ($booking->details->isEmpty()) {
            throw new RuntimeException(
                'Booking #' . $booking->booking_id . ' tidak memiliki detail layanan.'
            );
        }

        // Selalu generate order_id baru agar tidak konflik dengan transaksi sebelumnya
        $orderId = 'LUMIERE-' . $booking->booking_id . '-' . time();

        $itemDetails = $booking->details->map(function ($detail) {
            return [
                'id'       => (string) $detail->service_id,
                'price'    => (int) $detail->subtotal,
                'quantity' => (int) ($detail->qty ?? 1),
                'name'     => mb_substr($detail->service->nama_service, 0, 50),
            ];
        })->values()->toArray();

        // Validasi gross_amount harus cocok dengan sum item_details
        $grossAmount     = (int) $booking->total_harga;
        $itemsTotal      = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $itemDetails));

        if ($grossAmount !== $itemsTotal) {
            // Tambahkan adjustment item agar tidak ditolak Midtrans
            $diff = $grossAmount - $itemsTotal;
            $itemDetails[] = [
                'id'       => 'ADJUSTMENT',
                'price'    => $diff,
                'quantity' => 1,
                'name'     => 'Price Adjustment',
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $booking->customer->name,
                'email'      => $booking->customer->email,
            ],
            'item_details' => $itemDetails,
            'callbacks'    => [
                'finish' => route('customer.bookings.index'),
            ],
        ];

        $snap = Snap::createTransaction($params);

        $booking->payment->update([
            'midtrans_order_id'  => $orderId,
            'snap_token'         => $snap->token,
            'snap_redirect_url'  => $snap->redirect_url,
        ]);

        return $snap;
    }
}
