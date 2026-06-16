<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use App\Models\Service;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $featuredSalons = Salon::with(['images', 'kota'])
            ->where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        $featuredServices = Service::with(['salon', 'category'])
            ->latest()
            ->take(5)
            ->get();

        $latestReviews = Review::with(['customer', 'salon'])
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact(
            'featuredSalons',
            'featuredServices',
            'latestReviews'
        ));
    }
}