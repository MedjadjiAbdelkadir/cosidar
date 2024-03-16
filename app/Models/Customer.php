<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'customers';
    protected $fillable = [
        'nom',
        'pernom',
        'email',
        'phone',
        'date_naissance',
        'adresse',
        'nationalité',
        'type_juridique'
    ];
}
