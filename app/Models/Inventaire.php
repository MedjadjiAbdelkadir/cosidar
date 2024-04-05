<?php

namespace App\Models;

use App\Models\Ilot;
use App\Models\Product;
use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventaire extends Model
{
    use HasFactory;
    protected $table = 'inventaire';

    protected $fillable = [
        // 'denomination',
        // 'nature',
        // 'service_affectataire',
        // 'localite',
        // 'pays',
        // 'ville',
        // 'id_inventaire',
        'num_ilot',
        'date_inv',
        'designation',
        'photos',
        'vedio',
        // 'autre',
        'observation',
        // 'trial251',
        // 'CtegoreDeBien',
        // 'DateInventaire',
        // 'idFournisseur',
        // 'prixDacha',

        'Denom_Ilot', 
        'Denomination_fr', 
        'paye_name', 
        'responsable_inventaire', 
        'statut_inventaire', 
        'TypeInventaire'
    ];

    public function ilot()
    {
        return $this->belongsTo(Ilot::class, 'num_ilot', 'id');     
    }

    public function fournisseurs()
    {
        return $this->hasMany(Fournisseur::class, 'inventaire_id', 'id');     
    }

    public function articles()
    {
        return $this->hasMany(Product::class, 'inventaire_id', 'id');     
    }
}
