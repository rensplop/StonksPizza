<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['naam', 'price']; // evt. ook 'slug'

    public function pizzas()
    {
        return $this->hasMany(Pizza::class, 'size_id');
    }
}
