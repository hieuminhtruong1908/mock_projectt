<?php

namespace App;

use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'nickname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses(){
        return $this->hasMany('App\Models\Course');
    }
    public function roles(){
        return $this->hasMany('App\Models\Role', 'user_id');
    }
    public function groups(){
        return $this->hasMany('App\Models\Group','creator');
    }
    public function rolesActive(){
        return $this->hasMany('App\Models\Role', 'user_id')->where('status',Role::ROLE_STATUS_ACTIVE);
    }
}
