<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Salon;
use App\Models\Service;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalSalons = Salon::count();
        $totalServices = Service::count();
        $totalBookings = Booking::count();

        $completedBookings = Booking::where('status_booking', 'completed')->count();
        $pendingBookings = Booking::where('status_booking', 'pending')->count();
        $cancelledBookings = Booking::where('status_booking', 'cancelled')->count();

        $totalRevenue = Payment::where('payment_status', 'paid')->sum('total_bayar');

        $averageRating = Review::avg('rating');

        $latestBookings = Booking::with(['customer', 'salon', 'payment'])
            ->latest()
            ->take(5)
            ->get();
        
        $bookingChart = [
            'Pending' => Booking::where('status_booking', 'pending')->count(),
            'Paid' => Booking::where('status_booking', 'paid')->count(),
            'Completed' => Booking::where('status_booking', 'completed')->count(),
            'Cancelled' => Booking::where('status_booking', 'cancelled')->count(),
        ];
        $bookingByCategory = DB::table('booking_details')
            ->join('services', 'booking_details.service_id', '=', 'services.service_id')
            ->join('categories', 'services.category_id', '=', 'categories.category_id')
            ->join('bookings', 'booking_details.booking_id', '=', 'bookings.booking_id')
            ->select(
                'categories.nama_category',
                DB::raw('COUNT(DISTINCT bookings.booking_id) as total_booking')
            )
            ->groupBy('categories.category_id', 'categories.nama_category')
            ->orderByDesc('total_booking')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalSalons',
            'totalServices',
            'totalBookings',
            'completedBookings',
            'pendingBookings',
            'cancelledBookings',
            'totalRevenue',
            'averageRating',
            'latestBookings',
            'bookingChart',
            'bookingByCategory'        
        ));
    }
}