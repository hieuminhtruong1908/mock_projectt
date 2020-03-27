<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['level'];

    protected $appends = ['is_mentor', 'is_member'];

    const ROLE_STATUS_ACTIVE = 1;
    const ROLE_STATUS_DEACTIVE = 0;


    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getIsMentorAttribute()
    {
        return $this->level == 2;
    }

    public function getIsMemberAttribute()
    {
        return $this->level == 1;
    }
}

