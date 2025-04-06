<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'client_id',
        'annonce_id',
        'content',
        'rating',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
