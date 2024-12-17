<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PizzasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $pizzas = \App\Models\Pizza::factory(5)->create();
    
        $ingredients = \App\Models\Ingredient::factory(15)->create();
    
        $pizzas->each(function ($pizza) use ($ingredients) {
            $pizza->ingredienten()->attach($ingredients->random(rand(2, 5))->pluck('id')->toArray());
        });
    }    
}
