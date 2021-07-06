<?php

namespace App\Http\Resources\Web;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
        $Object['user_id'] = $this->user_id;
        $Object['User'] = new UserResource($this->user);
        $Object['advertisement_id'] = $this->advertisement_id;
        $Object['comment_id'] = $this->comment_id;
        $Object['comment'] = $this->comment;
        $Object['created_at'] = Carbon::parse($this->created_at)->diffForHumans();
        $Object['Replies'] = CommentResource::collection($this->replies);
        return $Object;
    }

}
