<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with([
            'salon',
            'staff',
            'details.service',
            'payment',
            'review'
        ])
        ->where('customer_id', auth()->id())
        ->latest()
        ->get();

        return view('customer.bookings.index', compact('bookings'));
    }
}