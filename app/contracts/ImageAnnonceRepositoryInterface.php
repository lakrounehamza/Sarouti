<?php

namespace App\Contracts;
use App\Http\Requests\CreateImageRequest;
use App\Http\Requests\UpdateImageRequest;
interface ImageAnnonceRepositoryInterface
{
    public function getAllImagesByAnnonceId($annonceId);
    public function getImageById($imageId);
    public function createImage(CreateImageRequest $attributes);
    public function updateImage($imageId,UpdateImageRequest $attributes);
    public function deleteImage($imageId);
}