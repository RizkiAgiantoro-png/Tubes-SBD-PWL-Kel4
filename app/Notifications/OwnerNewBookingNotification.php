<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OwnerNewBookingNotification extends Notification
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
            'customer',
            'salon',
            'staff',
            'details.service',
            'payment',
        ]);

        return (new MailMessage)
            ->subject('Booking Baru Masuk di Lumiere')
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Ada booking baru untuk salon kamu.')
            ->line('Salon: ' . $this->booking->salon->nama_salon)
            ->line('Customer: ' . $this->booking->customer->name)
            ->line('Tanggal: ' . $this->booking->booking_date)
            ->line('Jam: ' . $this->booking->booking_time)
            ->line('Staff: ' . ($this->booking->staff?->nama_staff ?? 'Bebas staff'))
            ->line('Total: Rp ' . number_format($this->booking->total_harga, 0, ',', '.'))
            ->action('Lihat Booking Masuk', route('owner.bookings.index'))
            ->line('Silakan cek dashboard owner untuk mengelola booking ini.');
    }
}