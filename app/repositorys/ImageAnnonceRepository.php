<?php

namespace App\Repositorys;

use App\Contracts\ImageAnnonceRepositoryInterface;
use App\Models\Images_annonce;
use App\Http\Requests\CreateImageRequest;
use App\Http\Requests\UpdateImageRequest;

class ImageAnnonceRepository implements ImageAnnonceRepositoryInterface
{
    public function getAllImagesByAnnonceId($annonceId)
    {
        $images = Images_annonce::where('annonce_id', $annonceId)->get();
        return $images;
    }
    public function getImageById($imageId)
    {
        $image = Images_annonce::find($imageId);
        return $image;
    }
    public function createImage(CreateImageRequest $attributes ,$annonceId)
    {
        Images_annonce::create([
            'path' => $attributes->path,
            'annonce_id' => $annonce_id,
        ]);
    }
    public function updateImage($imageId, UpdateImageRequest $attributes)
    {
        $image = Images_annonce::find($imageId);
        $image->update($attributes->all());
    }
    public function deleteImage($imageId)
    {
        $image = Images_annonce::find($imageId);
        $image->delete();
    }
}
