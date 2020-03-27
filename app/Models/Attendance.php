<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    const ATTENDANCE_STATUS_PRESENT = 1;
    const ATTENDANCE_STATUS_ABSENT = 0;
    protected $fillable = [
         'member_id', 'content_id', 'note', 'status'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'member_id', 'id');
    }
}

