<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    public function run()
    {
        Size::create(['naam' => 'Extreem groot',  'slug' => 'Huge']);
        Size::create(['naam' => 'Groot',  'slug' => 'Big']);
        Size::create(['naam' => 'Medium',  'slug' => 'Medium']);
        Size::create(['naam' => 'Small',  'slug' => 'Klein']);

    }
}
