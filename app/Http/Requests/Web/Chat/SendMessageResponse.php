<?php

namespace App\Http\Requests\Web\Chat;

use App\Events\SendMessageEvent;
use App\Http\Resources\Web\ChatMessageResource;
use \App\Helpers\ResponseRequest as Response;
use App\Models\ChatMessage;

class SendMessageResponse extends Response
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'chat_room_id'=>'required|exists:chat_rooms,id',
            'message'=>'required|string',
        ];
    }
    public function preset(){
        $logged = auth()->user()->id;
        $Object = new ChatMessage();
        $Object->setMessage($this->message);
        $Object->setUserId($logged);
        $Object->setChatRoomId($this->chat_room_id);
        $Object->save();
        $Object->refresh();
        SendMessageEvent::dispatch(new ChatMessageResource($Object));
        return $this->successJsonResponse([],new ChatMessageResource($Object),'ChatMessage');
    }
}
