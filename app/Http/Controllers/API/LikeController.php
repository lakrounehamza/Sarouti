<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositorys\LikeRepository;
use App\Http\Requests\CreateLikeRequest;

class LikeController extends Controller
{
    private $likeRepository;
    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }
    public function store(CreateLikeRequest $request)
    {
        $this->likeRepository->createLike($request);
        return response()->json([
            'success' => true,
            'message' => 'Like created successfully'
        ]);
    }
    public function destroy($id)
    {
        try {
            $this->likeRepository->deleteLike($id);
            return response()->json([
                'success' => true,
                'message' => 'Like deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting like: ' . $e->getMessage()
            ], 500);
        }
    }
}
