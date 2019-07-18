<?php

namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * define level of user
     */
    const isAdmin = 2;

    const isUser = 1;

    const isNotActive = 0;

    const isBlocked = 3;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'level', 'remember_token', 'create_at', 'provider', 'provider_id', 'isVip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function tasks()
    {
        return $this->hasMany('App\Entities\Tasks');
    }
}
