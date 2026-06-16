<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'nama_category'
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}