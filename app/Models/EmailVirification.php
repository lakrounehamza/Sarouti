<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVirification extends Model
{
    protected $fillable = [
        'email',
        'token',
        'email_expired_at',
    ];


}
