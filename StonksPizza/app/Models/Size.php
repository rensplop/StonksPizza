<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['naam', 'price'];

    public function pizzas()
    {
        return $this->hasMany(Pizza::class);
    }
}
