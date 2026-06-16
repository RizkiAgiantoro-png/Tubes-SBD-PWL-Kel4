<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'customer_id',
        'salon_id',
        'staff_id',
        'booking_date',
        'booking_time',
        'total_harga',
        'status_booking'
    ];

    protected $casts = [
        'customer_id' => 'integer',
        'salon_id'    => 'integer',
        'total_harga' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function salon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function details()
    {
        return $this->hasMany(
            BookingDetail::class,
            'booking_id'
        );
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'booking_id');
    }
}