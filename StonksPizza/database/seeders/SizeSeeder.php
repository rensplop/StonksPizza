<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    public function run()
    {
        Size::create(['naam' => 'Extreem groot',  'slug' => 'Huge']);

    }
}
