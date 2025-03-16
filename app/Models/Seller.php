<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }
}
