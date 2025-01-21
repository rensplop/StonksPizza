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
        'image'
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
