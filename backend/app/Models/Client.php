<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends User
{
    public function  like() {
        return $this->hasMany(Like::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
