<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'name', 'slug', 'thumbnail', 'description', 'created_at', 'user_id'
    ];

    public function author()
    {
        return $this->belongsTo('App\User','user_id');
    }
}

