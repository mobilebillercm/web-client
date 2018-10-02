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
        'userid', 'firstname', 'lastname', 'email', 'username', 'tenant', 'tenant_name', 'parent', 'password', 'roles', 'access_token', 'expires_in', 'mobilebillercreditaccount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function __construct($userid = null, $firstname = null, $lastname = null, $email = null,  $username = null, $tenant = null, $tenant_name = null, $parent = null,
                                $password = null, $roles = null, $expires_in = null, $mobilebillercreditaccount = null, array $attributes = [])
    {
        parent::__construct($attributes);

        $this->userid = $userid;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->username = $username;
        $this->tenant = $tenant;
        $this->tenant_name = $tenant_name;
        $this->parent = $parent;
        $this->password = $password;
        $this->roles = $roles;
        $this->access_token = $expires_in;
        $this->mobilebillercreditaccount = $mobilebillercreditaccount;
    }
}
