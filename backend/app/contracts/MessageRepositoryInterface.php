<?php

namespace App\Contracts;
use App\Http\Requests\createMessage;
interface MessageRepositoryInterface
{
    public function createMessage(createMessage $request);
    public function deleteMessage(string $id);
    public function getAllMessagesByUsers(string $senderId, string $receiverId);
    public function getMessageById(string $id);
    public function getAllMessagesBySenderId(string $senderId);
}
