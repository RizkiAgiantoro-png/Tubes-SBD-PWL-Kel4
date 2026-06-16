<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Salon;
use Illuminate\Http\Request;

class SalonBrowseController extends Controller
{
public function index(Request $request)
{
    $query = Salon::with([
        'images',
        'kota',
        'services.category'
    ])
    ->where('status', 'active');

    if ($request->filled('search')) {
        $query->where('nama_salon', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('kota')) {
        $query->whereHas('kota', function ($q) use ($request) {
            $q->where('nama_kota', $request->kota);
        });
    }

    if ($request->filled('category')) {
        $query->whereHas('services.category', function ($q) use ($request) {
            $q->where('nama_category', $request->category);
        });
    }

    if ($request->filled('sort')) {
        if ($request->sort === 'rating') {
            $query->orderByDesc('rating');
        }

        if ($request->sort === 'latest') {
            $query->latest();
        }
    } else {
        $query->latest();
    }

    $salons = $query
        ->paginate(45)
        ->withQueryString();

    $mapSalons = $salons
        ->getCollection()
        ->filter(function ($salon) {
            return !is_null($salon->latitude)
                && !is_null($salon->longitude);
        })
        ->map(function ($salon) {
            return [
                'id' => $salon->salon_id,
                'name' => $salon->nama_salon,
                'address' => $salon->alamat,
                'city' => $salon->kota?->nama_kota,
                'rating' => $salon->rating,
                'latitude' => (float) $salon->latitude,
                'longitude' => (float) $salon->longitude,
                'url' => route('customer.salons.show', $salon->salon_id),
            ];
        })
        ->values();

    $kotas = \App\Models\Kota::orderBy('nama_kota')->get();

    $categories = \App\Models\Category::orderBy('nama_category')->get();

    return view('customer.salons.index', compact(
        'salons',
        'mapSalons',
        'kotas',
        'categories'
    ));
}

    public function show(Salon $salon)
    {
        $salon->load([
            'kota',
            'images',
            'services.category',
            'staff',
            'reviews.customer'
        ]);

        return view('customer.salons.show', compact('salon'));
    }

    public function booking(Salon $salon)
    {
        $salon->load(['services', 'staff']);

        return view('customer.salons.booking', compact('salon'));
    }
}