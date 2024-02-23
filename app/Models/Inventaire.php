<?php

namespace App\Models;

use App\Models\Ilot;
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
    ];

    public function ilot()
    {
        return $this->belongsTo(Ilot::class, 'num_ilot', 'id');     
    }
}
