<?php

namespace App\Models;

use App\Models\Utility;
use App\Models\Batiment;
use App\Models\AnxEntretien;
use App\Models\AnxNatureImm;
use App\Models\Proprietaire;
use App\Models\ReferenceActe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ilot extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'dbo_ilot';

    protected $fillable = [
        'proprietaire_id',
        'Num_ilot',
        'N_ilot',
        'Denom_Ilot',
        'Denom_Ilot_ar',
        'Nature',
        'Nature_ar',
        'Utlisation',
        'Utlisation_ar',
        'Rue_fr',
        'Rue_ar',
        'Localite',
        'Localite_ar',
        'Ville',
        'ville_ar',
        'Pays_ar',
        'Pays',
        'il_surf_cadastree',
        'tot_sup_bati',
        'tot_sup_SDHO',
        'Num_Rue',
        'nb_batiment',
        'nb_lot',
        'Tot_sub_locaux',
        'Int_VV',
        'Int_VV_ar',
        'NumVV',
        'mantant_VV',
        'Int_VL',
        'Int_VLAr',
        'mantant_VL',
        'NumVL',
        'Age',
        'Num_Entretien',
        'intit_Entretien',
        'intit_Entretien_ar',
        'nb_batis',
        'Origine_Acte',
        'Origine_Acte_ar',
        'type_enquete',
        'type_enquete_ar',
        'Observation_enqueteur',
        'date_sais',
        'date_Enquete',
        'Num_enqui',
        'cord_X',
        'cord_y',
        'image',
        'mantVV',
        'mantVL',
        'validation',
        'created_by'
    ];


    ///////////////////////
    public function batiments()
    {
        return $this->hasMany(Batiment::class, 'Num_ilot', 'Num_ilot');
    }

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class, 'proprietaire_id', 'proprietaire_id');
    }

    public function acteReference()
    {
        return $this->hasOne(ReferenceActe::class, 'Num_ilot', 'Num_ilot');
    }

    public function anx_nature_imm()
    {
        return $this->belongsTo(AnxNatureImm::class, 'Nature', 'Num_Nat_imm');
    }


    public function anx_entretien()
    {
        return $this->belongsTo(AnxEntretien::class, 'intit_Entretien', 'num_Lv');
    }

    //////////////////////
    public function dateFormat($date)
    {
        $settings = Utility::settings();

        return date($settings['site_date_format'], strtotime($date));
    }

    public function timeFormat($time)
    {
        $settings = Utility::settings();

        return date($settings['site_time_format'], strtotime($time));
    }

    public function datetimeFormat($datetime)
    {
        $settings = Utility::settings();

        return date($settings['site_date_format'], strtotime($datetime)) . ' ' . date($settings['site_time_format'], strtotime($datetime));
    }


    public function getCreatedBy()
    {
        return ($this->parent_id == '0' || $this->parent_id == '1') ? $this->id : $this->parent_id;
    }
}
