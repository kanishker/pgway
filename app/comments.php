<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use App\Model\Post;
Use App\User;


class comments extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Post()
    {
        return $this->belongsTo(Post::class);
    }
    
}
