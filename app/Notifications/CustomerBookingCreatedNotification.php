<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerBookingCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Booking $booking
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $this->booking->load([
            'salon',
            'staff',
            'details.service',
            'payment',
        ]);

        return (new MailMessage)
            ->subject('Booking Lumiere Berhasil Dibuat')
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Booking kamu di Lumiere berhasil dibuat.')
            ->line('Salon: ' . $this->booking->salon->nama_salon)
            ->line('Tanggal: ' . $this->booking->booking_date)
            ->line('Jam: ' . $this->booking->booking_time)
            ->line('Staff: ' . ($this->booking->staff?->nama_staff ?? 'Bebas staff'))
            ->line('Total: Rp ' . number_format($this->booking->total_harga, 0, ',', '.'))
            ->action('Lihat Booking', route('customer.bookings.index'))
            ->line('Terima kasih sudah menggunakan Lumiere.');
    }
}