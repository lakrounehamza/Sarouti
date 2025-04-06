<?php

namespace App\Contracts;

interface CommentRepositoryInterface
{
    public function getCommentById($commentId);
    public function createComment($attributes);
    public function updateComment($commentId, $attributes);
    public function deleteComment($commentId);
    public function getCommentsByAnnonceId($annonceId);
    public function getCommentsByClientId($clientId);
    public function getCommentsByAnnonceIdAndClientId($annonceId, $clientId);
}
