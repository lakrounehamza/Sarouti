<?php

namespace App\Repositorys;
use App\Contracts\CommentRepositoryInterface;
use App\Models\Comment;
class CommentRepository implements CommentRepositoryInterface
{

    public function getCommentById($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment)
            return $comment;
    }
    
    
}
