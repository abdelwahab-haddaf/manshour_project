<?php

namespace App\Http\Requests\Web\Chat;

use App\Http\Resources\Web\ChatRoomResource;
use \App\Helpers\ResponseRequest as Response;
use App\Models\ChatRoom;
use App\Models\User;

class ChatRoomResponse extends Response
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }
    public function preset(){
        $logged = auth()->user()->id;
        $Objects = new ChatRoom();
        if($this->filled('q')){
            $q = $this->q;
            $Objects = $Objects->where(function ($query) use ($q) {
                $Users = User::where('name','Like','%'.$q.'%')->pluck('id');
                $query->whereIn('user_id_1',$Users)
                    ->orWhereIn('user_id_2',$Users);
            });
        }
        $Objects = $Objects->where(function ($query) use ($logged) {
            $query->where('user_id_1',$logged)
                ->orWhere('user_id_2',$logged);
        });
        $Objects = $Objects->orderBy('updated_at','desc');
        $Objects = $Objects->get();
        return $this->successJsonResponse([],ChatRoomResource::collection($Objects),'ChatRooms');
    }
}
