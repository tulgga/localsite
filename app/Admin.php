<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'f_name', 'l_name', 'user_name', 'email', 'phone', 'admin_type', 'status', 'site_id', 'heltes_id'
    ];

    protected $table = 'admin';

    protected $hidden = [
        'password', 'remember_token',
    ];
}
