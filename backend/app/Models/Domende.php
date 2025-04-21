<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domende extends Model
{
    protected $fillable = ['client_id', 'annonce_id', 'debu', 'fin', 'status'];
    public function client()
    {
        return $this->belongsTo(User::class);
    }
    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }

}
