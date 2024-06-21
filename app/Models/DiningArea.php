<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiningArea extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'dining_area_restaurant');
    }
}
