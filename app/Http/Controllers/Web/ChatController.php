<?php

namespace App\Http\Controllers\Web;


use App\Events\SendMessageEvent;
use App\Http\Requests\Web\Chat\ChatRoomMessageResponse;
use App\Http\Requests\Web\Chat\ChatRoomResponse;
use App\Http\Requests\Web\Chat\SendMessageResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ChatController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(){
        return view('Web.Chat.chat');
    }
    public function chat_rooms(ChatRoomResponse $response): JsonResponse
    {
        return $response->preset();
    }

    public function chat_room_messages(ChatRoomMessageResponse $response): JsonResponse
    {
        return $response->preset();
    }
    public function send_message(SendMessageResponse $response): JsonResponse
    {
        return $response->preset();
    }
}
