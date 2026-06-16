<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Salon;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $ownerId = auth()->id();

        $salonIds = Salon::where('owner_id', $ownerId)
            ->pluck('salon_id');

        $totalSalons = $salonIds->count();

        $totalServices = Service::whereIn('salon_id', $salonIds)
            ->count();

        $totalStaff = Staff::whereIn('salon_id', $salonIds)
            ->count();

        $totalBookings = Booking::whereIn('salon_id', $salonIds)
            ->count();

        $pendingBookings = Booking::whereIn('salon_id', $salonIds)
            ->where('status_booking', 'pending')
            ->count();

        $paidBookings = Booking::whereIn('salon_id', $salonIds)
            ->where('status_booking', 'paid')
            ->count();

        $completedBookings = Booking::whereIn('salon_id', $salonIds)
            ->where('status_booking', 'completed')
            ->count();

        $cancelledBookings = Booking::whereIn('salon_id', $salonIds)
            ->where('status_booking', 'cancelled')
            ->count();

        $totalRevenue = Payment::join('bookings', 'payments.booking_id', '=', 'bookings.booking_id')
            ->whereIn('bookings.salon_id', $salonIds)
            ->where('payments.payment_status', 'paid')
            ->sum('payments.total_bayar');

        $latestBookings = Booking::with([
                'customer',
                'salon',
                'staff',
                'payment',
                'details.service'
            ])
            ->whereIn('salon_id', $salonIds)
            ->latest()
            ->take(5)
            ->get();

        $bookingStatusChart = [
            'Pending' => $pendingBookings,
            'Paid' => $paidBookings,
            'Completed' => $completedBookings,
            'Cancelled' => $cancelledBookings,
        ];

        $bookingPerSalon = Salon::where('owner_id', $ownerId)
            ->withCount('bookings')
            ->orderByDesc('bookings_count')
            ->get()
            ->map(function ($salon) {
                return [
                    'nama_salon' => $salon->nama_salon,
                    'total_booking' => $salon->bookings_count,
                ];
            });

        return view('owner.dashboard', compact(
            'totalSalons',
            'totalServices',
            'totalStaff',
            'totalBookings',
            'pendingBookings',
            'paidBookings',
            'completedBookings',
            'cancelledBookings',
            'totalRevenue',
            'latestBookings',
            'bookingStatusChart',
            'bookingPerSalon'
        ));
    }
}