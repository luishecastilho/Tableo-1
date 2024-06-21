<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'minimum_capacity',
        'maximum_capacity',
        'active',
        'dining_area_id',
        'restaurant_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function diningArea()
    {
        return $this->belongsTo(DiningArea::class);
    }
}
