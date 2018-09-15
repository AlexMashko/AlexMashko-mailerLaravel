<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Mail\UserRegistered;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public static function boot()   //при создании новой записи туда еще нужно добавить случайное значение в поле token
    {
        parent::boot();

        static::creating(function ($user) {
            $user->token = str_random(30);
        });
    } 


    public function confirmEmail() //будет обнулять ключ и устанавливать значение поля verified равным true, в случае, если пользователь успешно подтвердит свой e-mail адрес.
    {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }
}
