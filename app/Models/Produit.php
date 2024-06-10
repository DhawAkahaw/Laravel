<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [

        'reference_contrat',

        'ref_produit_contrat',

        'reference',
        'nom_commercial',
        'etat',
        'etat_service',

    ];
}