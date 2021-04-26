<?php

namespace App;
use App\Model\Post;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
   
    public function Post()
    {
        return $this->belongsTo(Post::class);
    }
}
