<?php

namespace App\Models;

use App\Models\Ilot;
use App\Models\Local;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batiment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'dbo_batiment';
    protected $fillable = [
        'Num_Bat', 
        'bat_no', 
        'Num_ilot', 
        'Nbr_Niveau', 
        'sup_bati_cons', 
        'sup_SDHO', 
        'lot_bat', 
        'nom_bat', 
        'bat_desc', 
        'nbr_loc',
    ];
 
    public function locaux()
    {
        return $this->hasMany(Local::class, 'Num_Bat', 'Num_Bat');
    }

    public function ilot()
    {
        return $this->belongsTo(Ilot::class, 'Num_ilot', 'Num_ilot');
    }
}
