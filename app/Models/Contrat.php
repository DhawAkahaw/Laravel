<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',


        'reference_contrat',
        'designation',
        'date_de_debut',
        'etat',


    ];

}