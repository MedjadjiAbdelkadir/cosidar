<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatureLocaux extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'dbo_anx_nature_locaux';
    protected $fillable = [
        'NNatLoc',
        'intitule',
    ];
}
