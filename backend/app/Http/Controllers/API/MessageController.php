<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\createMessage;

use App\Repositorys\MessageRepository;

class MessageController extends Controller
{
    private $messageRepository;
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required',
        ]);
    
        $messages = $this->messageRepository->getAllMessagesByUsers($validated['sender_id'], $validated['receiver_id']);
        return response()->json($messages, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(createMessage $request)
    {
        $message = $this->messageRepository->createMessage($request);
        return response()->json($message, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $message = $this->messageRepository->getMessageById($id);
            return response()->json($message, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Message not found'], 404);
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
        try {
            $this->messageRepository->deleteMessage($id);
            return response()->json(['message' => 'Message deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Message not found'], 404);
        }
    }
    public function getAllMessagesBySenderId(string $id)
    {
        try {
            $messages = $this->messageRepository->getAllMessagesBySenderId($id);
            return response()->json($messages, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
