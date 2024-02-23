<?php

namespace App\Models;

use App\Models\Inventaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fournisseur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 
        'prenom', 
        'address', 
        'numero_telephone', 
        'email',
        'inventaire_id'
        // 'image',
    ];
    public static function selectFournisseur()
    {
        return self::all();
    }

    public function inventaire()
    {
        return $this->belongsTo(Inventaire::class, 'inventaire_id', 'id');     
    }
}
