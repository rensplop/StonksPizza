<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = [
        'naam',
        'size_id'
    ];

    public function ingredienten()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function getTotaalPrijsAttribute()
    {
        $sumIngredients = $this->ingredienten->sum('price');
        $base = $this->size ? $this->size->price : 0;
        return $base + $sumIngredients;
    }
}
