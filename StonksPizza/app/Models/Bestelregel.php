<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bestelregel extends Model
{
    protected $fillable = ['aantal', 'afmeting'];

    public function bestelling(): BelongsTo
    {
        return $this->belongsTo(Bestelling::class);
    }

    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }

    public function regelPrijs(): float
    {
        return $this->aantal * $this->pizza->prijs();
    }
}
