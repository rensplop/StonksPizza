<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bestelling extends Model
{
    use HasFactory;

    protected $table = 'bestellingen';
    protected $fillable = [
        'datum',
        'status',
        'klant_id',
        'user_id'
    ];

    public function bestelregels()
    {
        return $this->hasMany(Bestelregel::class);
    }
}
