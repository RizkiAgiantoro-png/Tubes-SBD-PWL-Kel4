<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSuccessNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Payment $payment
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $this->payment->load('booking.salon');

        return (new MailMessage)
            ->subject('Pembayaran Lumiere Berhasil')
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Pembayaran booking kamu berhasil dikonfirmasi.')
            ->line('Salon: ' . $this->payment->booking->salon->nama_salon)
            ->line('Total Bayar: Rp ' . number_format($this->payment->total_bayar, 0, ',', '.'))
            ->line('Status Pembayaran: Paid')
            ->action('Lihat Booking', route('customer.bookings.index'))
            ->line('Terima kasih sudah melakukan pembayaran di Lumiere.');
    }
}