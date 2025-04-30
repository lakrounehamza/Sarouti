<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Message;
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('messages.{id}', function ($user, $id) {
    return $user->id === Message::find($id)->receiver_id || $user->id === Message::find($id)->sender_id;
});