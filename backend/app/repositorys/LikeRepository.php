<?php

namespace App\Repositorys;
use App\Contracts\LikeRepositoryInterface;
use App\Models\Like;
use App\Http\Requests\CreateLikeRequest;
class LikeRepository implements LikeRepositoryInterface
{
    public function createLike(CreateLikeRequest $request)
    {
       Like::create([
            'client_id' => $request->client_id,
            'annonce_id' => $request->annonce_id,
        ]);
    }

    public function deleteLike($id)
    {
        $like = Like::find($id);
        if ($like) 
            $like->delete();
           
      
    }

    public function getLikesByAnnonceId($annonce_Id)
    {
        return Like::where('annonce_id', $annonce_Id)->get();
    }

    public function getLikesByClientId($client_Id)
    {
        return Like::where('client_id', $client_Id)->get();
    }
}
