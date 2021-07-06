<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property integer user_id
 * @property integer advertisement_id
 */
class Favourite extends Model
{
    protected $table = 'favourites';
    protected $fillable = ['user_id','advertisement_id',];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function advertisement(){
        return $this->belongsTo(Advertisement::class);
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

}
