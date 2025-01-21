<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bestelregel extends Model
{
    use HasFactory;

    protected $table = 'bestelregels';
    protected $fillable = [
        'aantal',
        'afmeting',
        'pizza_id',
        'bestelling_id'
    ];

    public function bestelling()
    {
        return $this->belongsTo(Bestelling::class);
    }

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }
}
