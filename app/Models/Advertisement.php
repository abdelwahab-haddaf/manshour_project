<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property integer user_id
 * @property integer category_id
 * @property integer sub_category_id_1
 * @property mixed sub_category_id_2
 * @property integer city_id
 * @property mixed title
 * @property mixed content
 * @property mixed contact
 * @property mixed hide_contact
 * @property mixed price
 * @property mixed sell_price
 * @property mixed sell_type
 * @property mixed delete_reason
 * @property boolean is_active
 * @property boolean is_deleted
 * @method Advertisement find(string $string)
 */
class Advertisement extends Model
{
    protected $table = 'advertisements';
    protected $fillable = ['user_id','category_id','sub_category_id_1','sub_category_id_2','city_id','title','content','contact','hide_contact','price','sell_price','sell_type','delete_reason','is_active','is_deleted',];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function sub_category_1(){
        return $this->belongsTo(Category::class,'sub_category_id_1','id');
    }
    public function sub_category_2(){
        return $this->belongsTo(Category::class,'sub_category_id_2','id');
    }
    public function media(){
        return $this->hasMany(Media::class,'ref_id','id');
    }
    public function first_media(){
        return $this->hasOne(Media::class,'ref_id','id');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function is_fav(){
        $fav = false;
        if(auth()->check()){
            $fav = (Favourite::where('advertisement_id',$this->id)->where('user_id',auth()->user()->id)->first())?true:false;
        }
        return $fav;
    }
    protected static function boot()
    {
        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
        parent::boot();
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
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->city_id;
    }

    /**
     * @param int $city_id
     */
    public function setCityId(int $city_id): void
    {
        $this->city_id = $city_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return mixed
     */
    public function getHideContact()
    {
        return $this->hide_contact;
    }

    /**
     * @param mixed $hide_contact
     */
    public function setHideContact($hide_contact): void
    {
        $this->hide_contact = $hide_contact;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getSellPrice()
    {
        return $this->sell_price;
    }

    /**
     * @param mixed $sell_price
     */
    public function setSellPrice($sell_price): void
    {
        $this->sell_price = $sell_price;
    }

    /**
     * @return mixed
     */
    public function getSellType()
    {
        return $this->sell_type;
    }

    /**
     * @param mixed $sell_type
     */
    public function setSellType($sell_type): void
    {
        $this->sell_type = $sell_type;
    }

    /**
     * @return mixed
     */
    public function getDeleteReason()
    {
        return $this->delete_reason;
    }

    /**
     * @param mixed $delete_reason
     */
    public function setDeleteReason($delete_reason): void
    {
        $this->delete_reason = $delete_reason;
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

    /**
     * @return int
     */
    public function getSubCategoryId1(): int
    {
        return $this->sub_category_id_1;
    }

    /**
     * @param int $sub_category_id_1
     */
    public function setSubCategoryId1(int $sub_category_id_1): void
    {
        $this->sub_category_id_1 = $sub_category_id_1;
    }

    /**
     * @return mixed
     */
    public function getSubCategoryId2()
    {
        return $this->sub_category_id_2;
    }

    /**
     * @param mixed $sub_category_id_2
     */
    public function setSubCategoryId2($sub_category_id_2): void
    {
        $this->sub_category_id_2 = $sub_category_id_2;
    }

}
