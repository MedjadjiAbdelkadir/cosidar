<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postes extends Model
{
    use HasFactory;

    protected $table = 'postes';

    protected $fillable = [
        'postes',
        'code_ii',
        'id_nomenclature',
    ];
}
