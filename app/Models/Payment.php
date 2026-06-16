<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'booking_id',
        'midtrans_order_id',
        'snap_token',
        'snap_redirect_url',
        'metode_pembayaran',
        'payment_date',
        'total_bayar',
        'payment_status',
        'transaction_status',
        'fraud_status',
        'payment_type',
    ];

    public function booking()
    {
        return $this->belongsTo(
            Booking::class,
            'booking_id'
        );
    }
}