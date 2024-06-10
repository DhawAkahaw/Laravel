<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'numero_facture',
        'montant_a_payer',
        'reste_a_payer',
        'prise_en_charge',
        'echeance',
        'pdf_facture'
    ];

    public function client()
    {
        return $this->belongsTo(client::class);
    }
}
