<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\comments;
use App\like;


class Post extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(comments::class);
    }
    public function like()
    {
        return $this->hasMany(like::class);
    }
    
}
