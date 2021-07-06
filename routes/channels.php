<?php

use Illuminate\Support\Facades\Broadcast;

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
//
//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});


//Broadcast::channel('new_message', function ($user, $chat_room_id) {
//Broadcast::channel('new_message', function () {
//    return true;
//    $ChatRoom = (new App\Models\ChatRoom)->find($chat_room_id);
//    return ($user->id === $ChatRoom->getUserId1()) || ($user->id === $ChatRoom->getUserId2());
//});

