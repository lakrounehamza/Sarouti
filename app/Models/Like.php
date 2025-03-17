<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'annonce_id',
        'client_id',
    ];
    
    public function  client(){
        return  $this->belongsTo(Client::class);
    }
    public function  annonce(){
        return  $this->belongsTo(Annonce::class);
    }
}
