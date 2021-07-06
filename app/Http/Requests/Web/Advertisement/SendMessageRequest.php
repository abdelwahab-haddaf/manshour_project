<?php

namespace App\Http\Requests\Web\Advertisement;

use App\Models\Advertisement;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'advertisement_id'=>'required|exists:advertisements,id',
            'message'=>'required|string'
        ];
    }
    public function preset(){
        $Object = (new Advertisement())->find($this->advertisement_id);
        $logged = auth()->user();
        $room1 = ChatRoom::where('user_id_1',$logged->id)->where('user_id_2',$Object->getUserId())->first();
        $room2 = ChatRoom::where('user_id_1',$Object->getUserId())->where('user_id_2',$logged->id)->first();
        if($room1){
            $room = $room1;
        }elseif ($room2){
            $room = $room2;
        }else{
            $room = new ChatRoom();
            $room->setUserId1($logged->id);
            $room->setUserId2($Object->getUserId());
            $room->save();
            $room->refresh();
        }
        $Message = new ChatMessage();
        $Message->setChatRoomId($room->getId());
        $Message->setMessage(__(' السلام عليكم ورحمة الله وبركاته، حاب استفسر بخصوص اعلانكم : '.$Object->getTitle()));
        $Message->setUserId($logged->id);
        $Message->save();
        $Message = new ChatMessage();
        $Message->setChatRoomId($room->getId());
        $Message->setMessage($this->message);
        $Message->setUserId($logged->id);
        $Message->save();
        return redirect('chat?chat_room_id='.$room->getId());
    }
}
