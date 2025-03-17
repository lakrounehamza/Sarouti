<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends User
{
    public function  like() {
        return $this->hasMany(Like::class);
    }
}
