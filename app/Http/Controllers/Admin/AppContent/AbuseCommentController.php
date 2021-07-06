<?php

namespace App\Http\Controllers\Admin\AppContent;

use App\Helpers\Constant;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\AppContent\AbuseComment\DeleteCommentRequest;
use App\Models\AbuseReport;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\City;
use App\Models\Comment;
use App\Models\CommentReport;
use App\Models\User;
use App\Traits\AhmedPanelTrait;

class AbuseCommentController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('admin/app_content/abuse_comments');
        $this->setEntity(new CommentReport());
        $this->setTable('comment_abuse_reports');
        $this->setLang('CommentReport');
        $this->setCreate(false);
        $this->setColumns([
            'user_id'=> [
                'name'=>'user_id',
                'type'=>'relation',
                'relation'=>[
                    'data'=> User::all(),
                    'name'=>'name',
                    'entity'=>'user'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'comment_id'=> [
                'name'=>'comment_id',
                'type'=>'relation',
                'relation'=>[
                    'data'=> Comment::all(),
                    'name'=>'comment',
                    'entity'=>'comment'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'abuse_report_id'=> [
                'name'=>'abuse_report_id',
                'type'=>'relation',
                'relation'=>[
                    'data'=> AbuseReport::all(),
                    'name'=>(session('my_locale')=='ar')?'name_ar':'name',
                    'entity'=>'abuse_report'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'details'=> [
                'name'=>'details',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->SetLinks([
            'delete_comment'=>[
                'route'=>'delete_comment',
                'icon'=>'fa-window-close',
                'lang'=>__('crud.Advertisement.Links.delete_comment'),
                'condition'=>function(){
                    return true;
                }
            ],
        ]);
    }
    public function delete_comment(DeleteCommentRequest $request, $id){
        return $request->preset($this,$id);

    }
}
