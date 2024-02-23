<?php

namespace App\Models;

use App\Models\Ilot;
use App\Models\Tutelle;
use App\Models\Utility;
use App\Models\AnxStatut;
use App\Models\Deciaffect;
use App\Models\AnxTextCreati;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proprietaire extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'dbo_personne';
     protected $fillable = [

        'pe_num',      
        'Denomination_fr',
        'Denomination_ar', 
        'Statut', 
        'Statut_ar',   
        'Tutelle', 
        'Tutelle_ar',  
        'txt_creation',    
        'txt_creation_ar',     
        'Num_txt_creation',  
        'Date_txt_creation',   
        'Decision_affectation',    
        'Decision_affectationAr',  
        'Num_Decision_affectation',    
        'Date_Decision_affectation',   
        'N_creation',  
        'N_Decision_affectation',  
        'Num_Statut',  
        'Num_tutelle', 

        'CODE_II',
        'NOMENCLATURE',
        'paye_name',
        'paye_region',
        'paye_code',
        'Ref_JRN',
    ];

    public function ilot()
    {
        return $this->hasMany(Ilot::class, 'proprietaire_id', 'id');
        // return $this->hasMany(Ilot::class, 'id', 'proprietaire_id');
    }
 
 
    public function tutelle()
    {
        return $this->belongsTo(Tutelle::class, 'Tutelle', 'bi_natjur');
    }
 
    public function statut()
    {
        return $this->belongsTo(AnxStatut::class, 'Statut', 'bi_natjur');
    }   
 
    public function deciaffect()
    {
        return $this->belongsTo(Deciaffect::class, 'Decision_affectation', 'Deci_Af');
    }   
 
    public function anx_text_creati()
    {
        return $this->belongsTo(AnxTextCreati::class, 'txt_creation', 'bi_natjur');
    } 
 
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
