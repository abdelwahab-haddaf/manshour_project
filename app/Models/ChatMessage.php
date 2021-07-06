<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property integer chat_room_id
 * @property integer user_id
 * @property string message
 * @method ChatMessage find(int $id)
 */
class ChatMessage extends Model
{
    protected $table = 'chat_messages';
    protected $fillable = ['chat_room_id','user_id','message'];

    public function chat_room()
    {
        return $this->belongsTo(ChatRoom::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
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
    public function getChatRoomId(): int
    {
        return $this->chat_room_id;
    }

    /**
     * @param int $chat_room_id
     */
    public function setChatRoomId(int $chat_room_id): void
    {
        $this->chat_room_id = $chat_room_id;
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
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

}
