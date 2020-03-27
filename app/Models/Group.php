<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'name', 'slug', 'description', 'thumbnail', 'creator', 'start_date'
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }

    public function author()
    {
    	return $this->belongsTo('App\User', 'creator');
    }
    public function roles(){
        return $this->hasMany(Role::class,'group_id','id')->where('status',1);
    }

}
