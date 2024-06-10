<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Demande_Migration extends Model
{
    use HasFactory;

    protected $fillable = [
        'Contract',
        'current_offre',
        'desired_offre',
        'Ticket',
        'gsm',
        'State',
        'remarque',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function produit()
    {
        return $this->hasOne(Produit::class, 'contract_prod', 'contract');
    }
    
}
