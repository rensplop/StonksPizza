<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pizza extends Model
{
    protected $fillable = ['naam'];

    public function ingredienten(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_pizza');  // Using 'ingredient_pizza' pivot table
    }

    public function prijs(): float
    {
        return $this->ingredienten->sum('prijs');
    }
}
