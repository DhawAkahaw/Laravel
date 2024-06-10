<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'mail',
        'mail_rec',
        'pass',
        'client_id',
        'State',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
