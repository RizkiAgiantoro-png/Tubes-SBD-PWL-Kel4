<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        abort_if($booking->customer_id !== auth()->id(), 403);

        if ($booking->status_booking !== 'completed') {
            return back()->with('error', 'Review hanya bisa dibuat setelah booking selesai.');
        }

        if ($booking->review) {
            return back()->with('error', 'Booking ini sudah memiliki review.');
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'komentar' => ['nullable', 'string'],
        ]);

        Review::create([
            'booking_id' => $booking->booking_id,
            'customer_id' => auth()->id(),
            'salon_id' => $booking->salon_id,
            'rating' => $validated['rating'],
            'komentar' => $validated['komentar'],
        ]);

        $averageRating = Review::where('salon_id', $booking->salon_id)
            ->avg('rating');

        $booking->salon->update([
            'rating' => round($averageRating, 1),
        ]);

        return back()
        ->with('success_booking_id', $booking->booking_id)
        ->with('success', 'Review berhasil dikirim.');
    }
}