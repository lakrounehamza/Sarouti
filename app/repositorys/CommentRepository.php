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
        return Comment::create($attributes->all());
    }
    public function updateComment($commentId, UpdateCommentRequest $attributes)
    {
        $comment = Comment::find($commentId);
        if ($comment)
            $comment->update($attributes->all());
        return $comment;
    }

    
}
