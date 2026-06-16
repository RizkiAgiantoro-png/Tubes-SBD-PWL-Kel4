<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'review_id';

    protected $fillable = [
        'booking_id',
        'customer_id',
        'salon_id',
        'rating',
        'komentar'
    ];

    public function booking()
    {
        return $this->belongsTo(
            Booking::class,
            'booking_id'
        );
    }

    public function customer()
    {
        return $this->belongsTo(
            User::class,
            'customer_id'
        );
    }

    public function salon()
    {
        return $this->belongsTo(
            Salon::class,
            'salon_id'
        );
    }
}