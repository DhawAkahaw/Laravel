<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;

    protected $fillable = [
        'offre',
        'Service',
        'Category',
        'Motif_rec',
        'Image',
        'Message',
        'Ticket',
        'Motif',
        'State',
        'client_id',
        'gsm',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'gsm', 'gsm');
    }
}
