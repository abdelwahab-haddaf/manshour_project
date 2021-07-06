<?php

namespace App\Http\Requests\Web\Advertisement;

use App\Helpers\Constant;
use App\Models\Advertisement;
use App\Models\Comment;
use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comment'=>'required',
        ];
    }
    public function preset(){
        $Object = new Comment();
        $Object->setUserId(auth()->user()->getId());
        $Object->setAdvertisementId($this->advertisement_id);
        $Object->setComment($this->comment);
        $Object->save();
        return redirect()->back();
    }
}
