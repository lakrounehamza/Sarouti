<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images_annonce extends Model
{
    protected $fillable = [
        'path',
        'annonce_id',
    ];
}
