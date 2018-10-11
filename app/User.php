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
        'family_name',
        'registration_no',
        'ic_expiry_date',
        'home_address',
        'bank_id',
        'bank_account_no',
        'bank_account_name',
        'profile_pic',
        'image_1',
        'image_2',
        'user_agreement_no',
        'loan_status',
        'wallet_id',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public  function bank(){
        return $this->hasOne(Banks::class, 'id', 'bank_id');
    }

    public  function loan(){
        return $this->hasOne(Loan::class, 'user_id', 'id')->orderBy('id','desc');
    }

}