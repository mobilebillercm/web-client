<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userid', 'name', 'email', 'password', 'roles', 'access_token', 'expires_in'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function __construct($userid = null, $name = null, $email = null, $password = null, $roles = null, array $attributes = [])
    {
        parent::__construct($attributes);

        $this->userid = $userid;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;

    }
}
