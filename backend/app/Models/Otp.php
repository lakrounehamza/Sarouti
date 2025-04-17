<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        'client_id',
        'code',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
