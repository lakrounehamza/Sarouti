<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositorys\CommentRepository;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends Controller
{
    private $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCommentRequest $request)
    {
        try {
            $this->commentRepository->createComment($request);
            return response()->json([
                'success' => true,
                'message' => 'Comment created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'error creating comment: ' . $e->getMessage()
            ], 500);
        }       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = $this->commentRepository->getCommentById($id);
        if ($comment) {
            return response()->json([
                'success' => true,
                'comment' => $comment
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
