<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnxEntretien extends Model
{
    // AnxEntretien
    use HasFactory;
    use HasFactory;
    public $timestamps = false;

    protected $table = 'dbo_anx_entretien';
    protected $fillable = [
        'num_Lv',
        'intitule', 
    ];
}
