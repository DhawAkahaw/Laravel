<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'Reference',
        'Motif_demand',
        'Message',
        'Ticket',      
        'Service',     
        'Motif',     
        'State',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
