<?php

namespace App\Contracts;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
interface CommentRepositoryInterface
{
    public function getCommentById($commentId);
    public function createComment(CreateCommentRequest $attributes);
    public function updateComment($commentId, UpdateCommentRequest $attributes);
    public function deleteComment($commentId);
    public function getCommentsByAnnonceId($annonceId);
    public function getCommentsByClientId($clientId);
    public function getCommentsByAnnonceIdAndClientId($annonceId, $clientId);
}
