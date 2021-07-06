<?php

namespace App\Http\Requests\Admin\AppContent\AbuseComment;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Models\Comment;
use App\Models\CommentReport;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCommentRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
    public function preset($crud,$id){
        $Object = $crud->getEntity()->find($id);
        if(!$Object)
            return $crud->wrongData();
        Comment::where('id',$Object->getCommentId())->delete();
        CommentReport::where('comment_id',$Object->getCommentId())->delete();
        return redirect($crud->getRedirect())->with('status', __('admin.messages.saved_successfully'));
    }
}
