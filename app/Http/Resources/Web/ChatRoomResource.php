<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatRoomResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $Object['id'] = $this->id;
        $Object['User'] = new UserResource((auth()->user()->id == $this->user_id_1)? $this->user_2: $this->user_1);
        return $Object;
    }

}
