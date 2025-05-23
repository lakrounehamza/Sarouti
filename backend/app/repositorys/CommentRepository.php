<?php

namespace App\Repositorys;

use App\Contracts\CommentRepositoryInterface;
use App\Models\Comment;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentRepository implements CommentRepositoryInterface
{

    public function getCommentById($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment)
            return $comment;
    }
    public function createComment(CreateCommentRequest $attributes)
    {
        return Comment::create([
            'client_id'=> $attributes->client_id,
            'annonce_id'=> $attributes->annonce_id,
            'content'=> $attributes->content,
            'rating'=> $attributes->rating,
        ]);
    }
    public function updateComment($commentId, UpdateCommentRequest $attributes)
    {
        $comment = Comment::find($commentId);
        if ($comment)
            $comment->update($attributes->all());
        return $comment;
    }
    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment)
            $comment->delete();
    }
    public function getCommentsByAnnonceId($annonceId)
    {
        return Comment::where('annonce_id', $annonceId)->get();
    }
    public function getCommentsByClientId($clientId)
    {
        return Comment::where('client_id', $clientId)->get();
    }
    public function getCommentsByAnnonceIdAndClientId($annonceId, $clientId)
    {
        return Comment::where('annonce_id', $annonceId)->where('client_id', $clientId)->get();
    }
}
