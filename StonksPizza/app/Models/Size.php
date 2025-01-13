<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'sizes';

    protected $fillable = [
        'naam',
        'size_id',
        'slug',
    ];

    public function pizzas()
    {
        return $this->hasMany(Pizza::class, 'size_id');
    }

    public function size()
{
    return $this->belongsTo(Size::class, 'size_id');
}

}
