<?php

namespace App\Http\Requests\Web\Advertisement;

use App\Models\CommentReport;
use \App\Helpers\ResponseRequest as Response;

class ReportAbuseRequest extends Response
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment_id'=>'sometimes|exists:comments,id',
            'abuse_report_id'=>'required|exists:abuse_reports,id',
        ];
    }
    public function preset(){
        $CommentReport = new CommentReport();
        $CommentReport->setUserId(auth()->user()->getId());
        $CommentReport->setCommentId($this->comment_id);
        $CommentReport->setAbuseReportId($this->abuse_report_id);
        $CommentReport->setDetails(@$this->details);
        $CommentReport->save();
        return redirect()->back()->with(['message'=>__('messages.saved_successfully')]);
    }
}
