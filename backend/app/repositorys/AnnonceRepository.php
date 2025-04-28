<?php

namespace App\Repositorys;

use  App\Models\Annonce;
use  App\Http\Requests\CreateAnnonceRequest;
use  App\Http\Requests\UpdateAnnonceRequest;
use App\Models\Images_annonce;
use App\Models\Feature;
use Illuminate\Support\Str;
use App\Models\Domende;
class AnnonceRepository
{
    public function getAllAnnonce()
    {
        $annonces = Annonce::all();
        foreach ($annonces as $annonce) {
            $images = Images_annonce::where('annonce_id', $annonce->id)->get();
            $annonce->images = $images;
            $features = Feature::where('annonce_id', $annonce->id)->get();
            $annonce->features = $features;
        }
        return  $annonces;
    }
    public function getAnnonceById($annonceId)
    {
        $annonce = Annonce::find($annonceId);
        if ($annonce) {
            return  $annonce;
        }
    }
    public function createAnnonce(CreateAnnonceRequest $attributes)
    {


        $localisation = $attributes->latitude . ',' . $attributes->longitude;

        $annonce = Annonce::create([
            'title' => $attributes->title,
            'description' => $attributes->description,
            'price' => $attributes->price,
            'type' => $attributes->type,
            'ville' => $attributes->ville,
            'localisation' => $localisation,
            'seller_id' => $attributes->seller_id,
            'category_id' => $attributes->category_id,
        ]);

        if ($attributes->hasFile('images')) {
            foreach ($attributes->file('images') as $image) {
                if ($image->isValid()) {
                    $imageName = time() . Str::random(20) . '.' . $image->extension();
                    $path = $image->storeAs('uploads/photos', $imageName, 'public');

                    Images_annonce::create([
                        'path' => $path,
                        'annonce_id' => $annonce->id,
                    ]);
                } else {
                    return response()->json(['error' => 'Invalid file uploaded.'], 400);
                }
            }
        }

        if ($attributes->filled('features')) {
            foreach ($attributes->features as $featureTitle) {
                Feature::create([
                    'title' => $featureTitle,
                    'annonce_id' => $annonce->id,
                ]);
            }
        }

        return response()->json(['message' => 'Annonce created successfully!'], 201);
    }


    public function UpdateAnnonce($annonceId, UpdateAnnonceRequest  $attributes)
    {
        $annonce = Annonce::find($annonceId);
        if ($annonce)
            $annonce->update($attributes->all());
    }
    public function deleteAnnone($annonceId)
    {
        $annonce = Annonce::find($annonceId);
        if ($annonce) {
            $annonce->delete();
        }
    }
    public function getLastInsertedId()
    {
        return Annonce::latest()->first()->id;
    }
    public function getAnnonceByCategoryName($categoryName)
    {
        $annonces = Annonce::whereHas('category', function ($query) use ($categoryName) {
            $query->where('name', $categoryName);
        })->get();
        return $annonces;
    }
    public function  getAnnonceBySellerId($sellerId)
    {
        $annonces = Annonce::where('seller_id', $sellerId)->get();
        foreach ($annonces as $annonce) {
            $annonce->image = Images_annonce::where('annonce_id', '=', $annonce->id)->select('path')->first();
        }
        return $annonces;
    }
    public function getCommentsByAnnonceId($annonceId)
    {
        $annonce = Annonce::find($annonceId);
        if ($annonce) {
            return $annonce->comments;
        }
    }
    public function statisticSeller($id)
    {
         
        $anoncesCount = Annonce::where('seller_id', $id)
        ->selectRaw('count(*) as numbre_annonces')
        ->first();

    $domendesCount = Domende::join('annonces', 'annonces.id', '=', 'domendes.annonce_id')
        ->where('annonces.seller_id', $id)
        ->selectRaw('count(*) as numbre_domendes')
        ->first();

    return [
        'numbre_annonces' => $anoncesCount->numbre_annonces ?? 0,
        'numbre_domendes' => $domendesCount->numbre_domendes ?? 0,
    ]; 
    }
    function getAnnonceBySedllerId($sellerId)
    {
        $annonces = Annonce::where('seller_id', $sellerId)->get();
        foreach ($annonces as $annonce) {
            $annonce->image = Images_annonce::where('annonce_id', '=', $annonce->id)->select('path')->first();
        }
        return $annonces;
    } 
}
