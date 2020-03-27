<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    const CONTENT_STATUS_ACTIVE = 1;
    const CONTENT_STATUS_DEACTIVE = 0;
    const CONTENT_STATUS_HIDE = 2;

    protected $table = 'contents';

    protected $fillable = [
        'title', 'thumbnail', 'content', 'level', 'duration', 'documents', 'start_date', 'end_date', 'author', 'is_done', 'is_approve',
    ];

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }

    public function creator()
    {
    	return $this->belongsTo('App\User', 'author');
    }

    public function event()
    {
        return $this->hasMany('App\Models\Event', 'content_id', 'id');
    }
    public function attendances(){
        return $this->hasMany(Attendance::class,'content_id');
    }
}
