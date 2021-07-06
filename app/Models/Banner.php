<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property mixed name
 * @property mixed image
 * @property mixed url
 * @property Banner is_active
 */
class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = ['name','image','url','is_active'];

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return Banner
     */
    public function getIsActive(): Banner
    {
        return $this->is_active;
    }

    /**
     * @param Banner $is_active
     */
    public function setIsActive(Banner $is_active): void
    {
        $this->is_active = $is_active;
    }


}
