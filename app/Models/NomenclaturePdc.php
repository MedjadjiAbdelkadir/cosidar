<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomenclaturePdc extends Model
{
    use HasFactory;

    protected $table = 'nomenclature_pdc';

    protected $fillable = [
        'nomenclature',
    ];
}
