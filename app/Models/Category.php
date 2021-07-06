<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string name
 * @property string name_ar
 * @property integer parent_id
 * @property boolean is_active
 */
class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','name_ar','parent_id','is_active'];

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id');
    }
    public function children(){
        return $this->hasMany(Category::class,'parent_id','id');
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNameAr(): string
    {
        return $this->name_ar;
    }

    /**
     * @param string $name_ar
     */
    public function setNameAr(string $name_ar): void
    {
        $this->name_ar = $name_ar;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parent_id;
    }

    /**
     * @param int $parent_id
     */
    public function setParentId(int $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return bool
     */
    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     */
    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

}
