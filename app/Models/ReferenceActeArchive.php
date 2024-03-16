<?php

namespace App\Models;

use App\Models\Ilot;
use App\Models\Utility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferenceActeArchive extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'reference_actearchive';
    protected $fillable = [
        'Num_ilot',
    
        'Intitule',
        'lot_no',
        'bat_no',
        'Num_Nat_Acte',
        'NumConstruction_Acte',
        'Num_Origine_Acte',
        'date_pub',
        'volume1',
        'case11',
        'Ref_JRN',
        'nom_redact_acte',
        'nature_acte',
        'Construction_Acte',
        'Origine_Acte',  

        'datearchive'
    ];
 

    public function ilot()
    {
        return $this->belongsTo(Ilot::class, 'Num_ilot', 'Num_ilot');
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
