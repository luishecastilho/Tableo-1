<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Pivot;

class DiningAreaRestaurant extends Pivot
{
    protected $fillable = ['restaurant_id', 'dining_area_id'];
}
