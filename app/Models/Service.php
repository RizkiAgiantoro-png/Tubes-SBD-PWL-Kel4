<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'salon_id',
        'category_id',
        'nama_service',
        'durasi',
        'harga',
        'deskripsi'
    ];

    public function salon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class, 'service_id');
    }
}
