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

        'descrption',
        'garantie',
        'garanDateJusq',
        'dateAchat',
        'marque',
        'style',
        'serieNum',
        'EtaAticle',
        'remarque',
        'typeProduit',
        'founisseur_id',
        // 'image'
    ];

    public function inventaire()
    {
        return $this->belongsTo(Inventaire::class, 'inventaire_id', 'id');     
    }
}
