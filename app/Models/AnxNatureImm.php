<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnxNatureImm extends Model
{
    use HasFactory;
       
    public $timestamps = false;

    protected $table = 'dbo_anx_nature_imm';
    protected $fillable = [
        'Num_Nat_imm',
        'intitule', 
    ];
}
