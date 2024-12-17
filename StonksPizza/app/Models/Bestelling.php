<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bestelling extends Model
{
    protected $fillable = ['datum', 'status'];

    public function klant(): BelongsTo
    {
        return $this->belongsTo(Klant::class);
    }

    public function bestelregels(): HasMany
    {
        return $this->hasMany(Bestelregel::class);
    }

    public function totaalPrijs(): float
    {
        return $this->bestelregels->sum(function ($regel) {
            return $regel->regelPrijs();
        });
    }
}

