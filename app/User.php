<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'firstname',
        'lastname',
        'password',
        'email',
        'phone',
        'gender',
        'birth_date',
        'name',
        'registration_no',
        'is_set_rd',
        'profile_pic',
        'status',
        'verify',
        'is_volunteer',
        'new_email',
        'new_email_verify',
        'new_phone',
        'new_phone_verify',
        'site_id',
        'is_notification',
        'is_notification_email',
    ];

    public function AauthAcessToken(){
        return $this->hasMany('\App\OauthAccessToken');
    }

}