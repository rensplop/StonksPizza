<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pizza extends Model
{
    protected $fillable = [
        'naam',
        'size',  // <-- zodat we 'size' kunnen invullen
    ];

    public function ingredienten()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    /**
     * Berekent de totale prijs van de pizza als som van de ingrediënten + optionele groottetoeslag.
     */
    public function getTotalPriceAttribute()
    {
        // Som van ingrediënten
        $ingredientTotal = $this->ingredienten->sum('price');

        // Eventueel toeslag afhankelijk van grootte
        // (pas aan naar wens; hieronder voorbeeld)
        $sizeSurcharges = [
            'small'  => 0,
            'medium' => 2,
            'large'  => 4,
        ];
        
        $sizeSurcharge = $sizeSurcharges[$this->size] ?? 0;

        return $ingredientTotal + $sizeSurcharge;
    }
}