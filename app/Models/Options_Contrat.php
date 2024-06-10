<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;


class Options_Contrat extends Model
{
    use HasFactory;
    protected $fillable = [
        'contrat_id',
        'designation',
        'prix',


    ];
}