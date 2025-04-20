<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'title',
        'annonce_id',
    ];

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
