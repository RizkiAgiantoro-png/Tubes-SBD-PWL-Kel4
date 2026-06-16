<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalonImage extends Model
{
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'salon_id',
        'image_path',
        'image_type',
        'is_thumbnail'
    ];

    public function salon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }
}
