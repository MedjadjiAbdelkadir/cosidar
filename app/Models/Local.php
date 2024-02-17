<?php

namespace App\Models;

use App\Models\Utility;
use App\Models\Batiment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Local extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'dbo_locaux';
     protected $fillable = [
        'lot_no', 
        'Num_ilot', 
        'Num_Bat', 
        'lot_surface', 
        'bat_no', 
        'lot_bat', 
        'nb_indiv', 
        'Nature_Loc', 
        'mode_approp', 
        'droit_charge', 
        'type_enquete', 
        'nb_piece', 
        'NNatLoc', 
    ];
 
  //////////////
    public function batiment()
    {
        return $this->belongsTo(Batiment::class, 'Num_Bat', 'Num_Bat');
    }
 
  ///////////////
 
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
