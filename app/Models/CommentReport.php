<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property mixed comment_id
 * @property mixed user_id
 * @property mixed abuse_report_id
 * @property mixed details
 */
class CommentReport extends Model
{
    protected $table = 'comment_abuse_reports';
    protected $fillable = ['comment_id','user_id','abuse_report_id','details',];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
    public function abuse_report(){
        return $this->belongsTo(AbuseReport::class);
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->comment_id;
    }

    /**
     * @param mixed $comment_id
     */
    public function setCommentId($comment_id): void
    {
        $this->comment_id = $comment_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getAbuseReportId()
    {
        return $this->abuse_report_id;
    }

    /**
     * @param mixed $abuse_report_id
     */
    public function setAbuseReportId($abuse_report_id): void
    {
        $this->abuse_report_id = $abuse_report_id;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details): void
    {
        $this->details = $details;
    }
}
