<?php

namespace App\Repositorys;

use App\Contracts\MessageRepositoryInterface;
use App\Models\Message;
use App\Http\Requests\createMessage;
class MessageRepository implements MessageRepositoryInterface
{
    public function createMessage(createMessage $request)
    {
        return Message::create([
            'sender_id'=>$request->sender_id,
            'receiver_id'=>$request->receiver_id,
            'content'=>$request->content,
        ]);
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
    public function getAllMessagesBySenderId(string $senderId)
    {
        return Message::selectRaw(
            'DISTINCT ON (LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id)) 
            messages.id,
            sender_id,
            sender.name AS sender_name,
            sender.photo as sender_photo,
            receiver_id,
            receiver.name AS receiver_name,
            content,
            is_read,
            receiver.photo as receiver_photo,
            messages.created_at'
        )
        ->join('users as sender', 'sender.id', '=', 'messages.sender_id')
        ->join('users as receiver', 'receiver.id', '=', 'messages.receiver_id')
        ->where('sender_id', '=', $senderId)
        ->orWhere('receiver_id', '=', $senderId)
        ->orderByRaw('LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id), messages.created_at DESC')
        ->get();
    }
}
