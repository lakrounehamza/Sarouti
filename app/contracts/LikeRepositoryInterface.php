<?php

namespace App\contracts;
use App\Http\Requests\CreateLikeRequest;
interface LikeRepositoryInterface
{
    public function createLike( CreateLikeRequest $request);
    public function deleteLike($id);
    public function getLikesByAnnonceId($annonce_Id);
    public function getLikesByClientId($client_Id);
}
