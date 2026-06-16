<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Traits\SendsNotificationSafely;

class BookingController extends Controller
{
    use SendsNotificationSafely;
    public function index()
    {
        $bookings = Booking::with([
            'customer',
            'salon',
            'staff',
            'details.service',
            'payment'
        ])
        ->whereHas('salon', function ($query) {
            $query->where('owner_id', auth()->id());
        })
        ->latest()
        ->get();

        return view('owner.bookings.index', compact('bookings'));
    }

    public function complete(Booking $booking)
    {
        abort_if($booking->salon->owner_id !== auth()->id(), 403);

        $booking->update([
            'status_booking' => 'completed'
        ]);

        $this->notifySafely(
            $booking->customer,
            new \App\Notifications\BookingStatusUpdatedNotification($booking)
        );

        return back()->with('success', 'Booking berhasil diselesaikan.');
    }

    public function cancel(Booking $booking)
    {
        abort_if($booking->salon->owner_id !== auth()->id(), 403);

        $booking->update([
            'status_booking' => 'cancelled'
        ]);

        $this->notifySafely(
            $booking->customer,
            new \App\Notifications\BookingStatusUpdatedNotification($booking)
        );

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
}