<?php

namespace App\Http\Requests\Web\Advertisement;

use App\Http\Resources\Web\CommentResource;
use App\Models\Comment;
use \App\Helpers\ResponseRequest as Response;

class CommentPostResponseRequest extends Response
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
            'comment_id'=>'sometimes|exists:comments,id',
            'comment'=>'required',
        ];
    }
    public function preset(){
        $Object = new Comment();
        $Object->setUserId(auth()->user()->getId());
        $Object->setAdvertisementId($this->advertisement_id);
        $Object->setComment($this->comment);
        $Object->setCommentId(@$this->comment_id);
        $Object->save();
        $Object->refresh();
        $Object = new CommentResource($Object);
        return $this->successJsonResponse([],$Object,'Comment');
    }
}
