<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\DiningArea;

class RestaurantsTableSeeder extends Seeder
{
    public function run()
    {
        // Create Dining Areas
        $indoor = DiningArea::create(['name' => 'Indoor']);
        $outdoor = DiningArea::create(['name' => 'Outdoor']);
        $outdoorTerrace = DiningArea::create(['name' => 'Outdoor Terrace']);

        // Create Restaurants
        $greenRestaurant = Restaurant::create(['name' => 'Green Restaurant']);
        $blueRestaurant = Restaurant::create(['name' => 'Blue Restaurant']);

        // Attach Dining Areas to Restaurants
        $greenRestaurant->diningAreas()->attach([$indoor->id, $outdoor->id]);
        $blueRestaurant->diningAreas()->attach([$indoor->id, $outdoorTerrace->id]);

        // Variable to count the number of tables created
        $t = 1;

        // Create Tables for Green Restaurant
        // Indoor tables
        for ($i = 0; $i < 4; $i++) {
            Table::create([
                'name' => 'Table ' . ($t),
                'minimum_capacity' => 2,
                'maximum_capacity' => 4,
                'active' => true,
                'restaurant_id' => $greenRestaurant->id,
                'dining_area_id' => $indoor->id,
            ]);
            $t++;
        }

        for ($i = 0; $i < 2; $i++) {
            Table::create([
                'name' => 'Table ' . ($t),
                'minimum_capacity' => 3,
                'maximum_capacity' => 5,
                'active' => false,
                'restaurant_id' => $greenRestaurant->id,
                'dining_area_id' => $indoor->id,
            ]);
            $t++;
        }

        // Outdoor tables
        for ($i = 0; $i < 5; $i++) {
            Table::create([
                'name' => 'Table ' . ($t),
                'minimum_capacity' => 3,
                'maximum_capacity' => 5,
                'active' => true,
                'restaurant_id' => $greenRestaurant->id,
                'dining_area_id' => $outdoor->id,
            ]);
            $t++;
        }

        // Create Tables for Blue Restaurant
        // Indoor tables
        for ($i = 0; $i < 2; $i++) {
            Table::create([
                'name' => 'Table ' . ($t),
                'minimum_capacity' => 1,
                'maximum_capacity' => 2,
                'active' => true,
                'restaurant_id' => $blueRestaurant->id,
                'dining_area_id' => $indoor->id,
            ]);
            $t++;
        }

        // Outdoor Terrace tables
        for ($i = 0; $i < 2; $i++) {
            Table::create([
                'name' => 'Table ' . ($t),
                'minimum_capacity' => 3,
                'maximum_capacity' => 5,
                'active' => true,
                'restaurant_id' => $blueRestaurant->id,
                'dining_area_id' => $outdoorTerrace->id,
            ]);
            $t++;
        }
    }
}
