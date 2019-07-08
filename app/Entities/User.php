<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Integer;

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
        'name', 'email', 'password', 'level', 'remember_token', 'create_at', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

}
