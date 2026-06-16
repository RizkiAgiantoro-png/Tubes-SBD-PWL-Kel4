<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $primaryKey = 'salon_id';

    protected $fillable = [
        'owner_id',
        'kota_id',
        'nama_salon',
        'alamat',
        'deskripsi',
        'rating',
        'jam_buka',
        'jam_tutup',
        'status',
        'latitude',
        'longitude'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }

    public function images()
    {
        return $this->hasMany(SalonImage::class, 'salon_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'salon_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'salon_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'salon_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'salon_id');
    }
}
