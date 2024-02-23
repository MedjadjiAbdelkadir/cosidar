<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'inventaire_id',
        'name', 
        'price', 
        'quantity',
        // 'image'
    ];

    public function inventaire()
    {
        return $this->belongsTo(Inventaire::class, 'inventaire_id', 'id');     
    }
}
