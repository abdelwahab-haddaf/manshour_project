<?php

namespace App\Http\Requests\Web\Advertisement;

use App\Http\Resources\Web\CommentResource;
use App\Models\Advertisement;
use App\Models\Comment;
use \App\Helpers\ResponseRequest as Response;

class CommentResponseRequest extends Response
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'advertisement_id'=>'sometimes|exists:advertisements,id',
        ];
    }
    public function preset(){
        $Object = (new Advertisement())->find($this->advertisement_id);
        $Objects = new Comment();
        $Objects = $Objects->where('advertisement_id',$Object->getId());
        $Objects = $Objects->whereNull('comment_id');
        $Objects = $Objects->orderBy('created_at','desc');
        $Objects = CommentResource::collection($Objects->paginate(($this->filled('per_page'))?$this->per_page:10));
        return $this->successJsonResponse([],$Objects->items(),'Comments',$Objects);
    }
}
