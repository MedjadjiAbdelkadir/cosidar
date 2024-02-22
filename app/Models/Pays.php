<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'paya';
    protected $fillable = [
        'id',
        'capital',
        'code',
        'continent',
        'flag_1x1',
        'flag_4x3',
        'iso',
        'name',
    ];
}
