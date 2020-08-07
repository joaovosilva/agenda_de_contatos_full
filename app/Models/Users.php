<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable implements JWTSubject, CanResetPassword
{
    protected $table = 'tb_users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'email',
        'password',
        'name'
    ];

    protected $hidden = [
        'password'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
