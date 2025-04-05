<?php

namespace App\Repositorys;

use  App\Models\Annonce;
use  App\Http\Requests\CreateAnnonceRequest;
use  App\Http\Requests\UpdateAnnonceRequest;
use App\Models\Images_annonce;

class AnnonceRepository
{
    public function getAllAnnonce()
    {
        $annonces = Annonce::all();
        return  $annonces;
    }
    public function getAnnonceById($annonceId)
    {
        $annonce = Annonce::find($annonceId);
        if ($annonce) {
            return  $annonce;
        }
    }
    public function createAnnonce(CreateAnnonceRequest  $attributes)
    {
        Annonce::create([
            'title' => $attributes->title,
            'description' => $attributes->description,
            'price' => $attributes->price,
            'type' => $attributes->type,
            'ville' => $attributes->ville,
            'status' => $attributes->status,
            'seller_id' => $attributes->seller_id,
            'category_id' => $attributes->category_id,
        ]);
    }
    public function UpdateAnnonce($annonceId, UpdateAnnonceRequest  $attributes)
    {
        $annonce = Annonce::find($annonceId);
        if ($annonce)
            $annonce->update($attributes->all());
    }
    public function deleteAnnone(Annonce $annonce)
    {
        $annonce->delete();
    }
}
