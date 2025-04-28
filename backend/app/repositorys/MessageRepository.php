<?php

namespace App\Repositorys;

use App\Contracts\MessageRepositoryInterface;
use App\Models\Message;
use App\Http\Requests\createMessage;
class MessageRepository implements MessageRepositoryInterface
{
    public function createMessage(createMessage $request)
    {
        return Message::create($request);
    }

    public function deleteMessage(string $id)
    {
        return Message::destroy($id);
    }

    public function getAllMessagesByUsers(string $senderId, string $receiverId)
    {
        return Message::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $senderId);
        })->orderBy('created_at', 'asc')->get();
    }

    public function getMessageById(string $id)
    {
        return Message::findOrFail($id);
    }
}
