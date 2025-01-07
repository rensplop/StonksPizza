<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        Ingredient::create(['naam' => 'Tomato', 'prijs' => 0,99]);
        Ingredient::create(['naam' => 'Cheese', 'prijs' => 1,99]);
        Ingredient::create(['naam' => 'Mushroom', 'prijs' => 12,99]);
        Ingredient::create(['naam' => 'Pepperoni', 'prijs' => 1,99]);
        Ingredient::create(['naam' => 'Olives', 'prijs' => 29,99]);
        Ingredient::create(['naam' => 'Onions', 'prijs' => 59,99]);
    }
}
