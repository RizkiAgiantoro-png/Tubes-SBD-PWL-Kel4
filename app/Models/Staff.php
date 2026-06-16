<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $primaryKey = 'staff_id';

    protected $fillable = [
        'salon_id',
        'nama_staff',
        'spesialisasi',
        'no_hp',
        'status'
    ];

    public function salon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'staff_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'staff_id');
    }
}