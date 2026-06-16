<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $primaryKey = 'kota_id';

    protected $fillable = [
        'nama_kota',
        'provinsi'
    ];

    public function salons()
    {
        return $this->hasMany(Salon::class, 'kota_id');
    }
}
