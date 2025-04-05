<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'type',
        'ville',
        'status',
        'seller_id',
        'category_id',
    ];
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images_annonce()
    {
        return $this->hasMany(Images_annonce::class);
    }
    public function like(){
        return  $this->hasMany(Like::class);
    }
}
