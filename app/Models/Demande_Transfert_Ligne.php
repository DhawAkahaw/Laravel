<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Demande_Transfert_Ligne extends Model
{
    use HasFactory;

    protected $fillable = [
        'adsl_num',
        'new_num_tel',
        'state_line_prop',
        'nic',
        'Ticket',
        'prev_num',
        'NOM',
        'CIN',
        'created_at',
        'Remarque',
        'client_id',
        'rue',
        'gouvernorat',
        'delegation',
        'localite',
        'ville',
        'code_postal',
        'State',
    ];


    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function produit()
    {
        return $this->hasOne(Contrat::class, 'reference', 'adsl_num');
    }
}
