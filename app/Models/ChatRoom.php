<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property integer user_id_1
 * @property integer user_id_2
 * @property boolean is_deleted
 * @method ChatRoom find(int $id)
 */
class ChatRoom extends Model
{
    protected $table = 'chat_rooms';
    protected $fillable = ['user_id_1','user_id_2','is_deleted'];

    public function user_1()
    {
        return $this->belongsTo(User::class,'user_id_1');
    }
    public function user_2()
    {
        return $this->belongsTo(User::class,'user_id_2');
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
    public function getUserId1(): int
    {
        return $this->user_id_1;
    }

    /**
     * @param int $user_id_1
     */
    public function setUserId1(int $user_id_1): void
    {
        $this->user_id_1 = $user_id_1;
    }

    /**
     * @return int
     */
    public function getUserId2(): int
    {
        return $this->user_id_2;
    }

    /**
     * @param int $user_id_2
     */
    public function setUserId2(int $user_id_2): void
    {
        $this->user_id_2 = $user_id_2;
    }

    /**
     * @return bool
     */
    public function isIsDeleted(): bool
    {
        return $this->is_deleted;
    }

    /**
     * @param bool $is_deleted
     */
    public function setIsDeleted(bool $is_deleted): void
    {
        $this->is_deleted = $is_deleted;
    }


}
