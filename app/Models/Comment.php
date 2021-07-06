<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property integer user_id
 * @property integer advertisement_id
 * @property integer|null comment_id
 * @property string comment
 */
class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id','advertisement_id','comment_id','comment'];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function advertisement(){
        return $this->belongsTo(Advertisement::class);
    }
    public function parent_comment(){
        return $this->belongsTo(Comment::class,'comment_id');
    }
    public function replies(){
        return $this->hasMany(Comment::class,'comment_id');
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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getAdvertisementId(): int
    {
        return $this->advertisement_id;
    }

    /**
     * @param int $advertisement_id
     */
    public function setAdvertisementId(int $advertisement_id): void
    {
        $this->advertisement_id = $advertisement_id;
    }

    /**
     * @return int|null
     */
    public function getCommentId(): ?int
    {
        return $this->comment_id;
    }

    /**
     * @param int|null $comment_id
     */
    public function setCommentId(?int $comment_id): void
    {
        $this->comment_id = $comment_id;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

}
