<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'naam',
        'size_id',
    ];

    public function ingredienten()
    {
        return $this->belongsToMany(Ingredient::class); 
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function getTotaalPrijsAttribute()
    {
        // Som van alle geselecteerde ingrediënten
        $ingredientTotal = $this->ingredienten->sum('price');

        // Prijs van de geselecteerde grootte (als die bestaat)
        $sizePrice = $this->size && $this->size->price
            ? $this->size->price
            : 0;

        return $ingredientTotal + $sizePrice;
    }
}
