<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingStatusUpdatedNotification extends Notification
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
        $this->booking->load('salon');

        $statusText = match ($this->booking->status_booking) {
            'completed' => 'Booking kamu telah selesai.',
            'cancelled' => 'Booking kamu telah dibatalkan.',
            default => 'Status booking kamu diperbarui.',
        };

        return (new MailMessage)
            ->subject('Status Booking Lumiere Diperbarui')
            ->greeting('Halo, ' . $notifiable->name)
            ->line($statusText)
            ->line('Salon: ' . $this->booking->salon->nama_salon)
            ->line('Tanggal: ' . $this->booking->booking_date)
            ->line('Jam: ' . $this->booking->booking_time)
            ->line('Status: ' . ucfirst($this->booking->status_booking))
            ->action('Lihat Booking', route('customer.bookings.index'))
            ->line('Terima kasih sudah menggunakan Lumiere.');
    }
}