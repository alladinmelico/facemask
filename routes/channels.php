<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use App\Models\Message;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// Broadcast::channel('chat', function ($user) {
//     return $user;
// });


Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    $message = Message::where('chat_id',$chatId)->first();
    return ($message->sender_id === $user->id) || ($message->receiver_id === $user->id);
});