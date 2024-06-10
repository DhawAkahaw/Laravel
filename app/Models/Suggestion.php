<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'Sugg_context',
        'Subject',
        'Message',
        'Ticket',
        'client_id',
    ];
    public function client()
    {
        return $this->belongsTo(client::class);
    }
}