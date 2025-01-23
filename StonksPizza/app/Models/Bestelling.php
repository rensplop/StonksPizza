<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bestelling extends Model
{
    protected $table = 'bestellingen';
    protected $fillable = [
        'datum',
        'status',
        'user_id'
    ];

    public function bestelregels()
    {
        return $this->hasMany(Bestelregel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
