<?php

namespace App\Http\Resources\Web;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessageResource extends JsonResource
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
        $Object['message'] = $this->message;
        $Object['User'] = new UserResource($this->user);
        $Object['created_at'] = Carbon::parse($this->created_at)->format('Y-m-d');
        $Object['is_mine'] = auth()->user()->id == $this->user_id;
        return $Object;
    }

}
