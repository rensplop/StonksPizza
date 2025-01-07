<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        Ingredient::create(['naam' => 'Tomato', 'prijs' => 4]);
        Ingredient::create(['naam' => 'Cheese', 'prijs' => 1]);
        Ingredient::create(['naam' => 'Mushroom', 'prijs' => 2]);
        Ingredient::create(['naam' => 'Pepperoni', 'prijs' => 4]);
        Ingredient::create(['naam' => 'Olives', 'prijs' => 2]);
        Ingredient::create(['naam' => 'Onions', 'prijs' => 3]);
    }
}
