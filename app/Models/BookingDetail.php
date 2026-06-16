<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $primaryKey = 'booking_detail_id';

    protected $fillable = [
        'booking_id',
        'service_id',
        'qty',
        'subtotal'
    ];

    public function booking()
    {
        return $this->belongsTo(
            Booking::class,
            'booking_id'
        );
    }

    public function service()
    {
        return $this->belongsTo(
            Service::class,
            'service_id'
        );
    }
}