<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

class Client extends Model implements CanResetPasswordContract
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    protected $fillable = [
        'name',
        'last_name',
        'rue',
        'gouvernorat',
        'delegation',
        'localite',
        'ville',
        'code_postal',
        'tel',
        'gsm',
        'login',
        'password',
        'picture',
        'code_Client',
        'type_Client',
    ];


    public function sendPasswordResetNotification($token)
    {
        $url = 'http://localhost:3000/resetforgottenpassword/' . $token;
        $this->notify(new ResetPasswordNotification($url));
    }


}