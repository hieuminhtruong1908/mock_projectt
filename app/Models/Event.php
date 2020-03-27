<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title', 'thumbnail', 'content', 'documents', 'start_date', 'end_date', 'author', 'speaker'
    ];

    public function group()
    {
        $this->hasMany('App\Models\Group', 'group_id', 'id');
    }
}
