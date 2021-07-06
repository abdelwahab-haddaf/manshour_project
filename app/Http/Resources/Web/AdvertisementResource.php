<?php

namespace App\Http\Resources\Web;

use App\Helpers\Constant;
use App\Models\Favourite;
use App\Models\Media;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $Object['id'] = $this->id;
        $Object['user_id'] = $this->user_id;
        $Object['User'] = new UserResource($this->user);
        $Object['category_id'] = $this->category_id;
        $Object['Category'] = new CategoryResource($this->category);
        $Object['sub_category_id_1'] = $this->sub_category_id_1;
        $Object['SubCategory'] = new CategoryResource($this->sub_category_1);
        $Object['sub_category_id_2'] = $this->sub_category_id_2;
        $Object['SubCategory2'] = ($this->sub_category_2)?new CategoryResource($this->sub_category_2):null;
        $Object['city_id'] = $this->city_id;
        $Object['City'] = new CityResource($this->city);
        $Object['title'] = $this->title;
//        $Object['content'] = (strlen($this->content) > 100)?substr($this->content, 0, 99):$this->content;
        $Object['contact'] = $this->contact;
        $Object['hide_contact'] = $this->hide_contact;
        $Object['price'] = $this->price;
        $Object['sell_price'] = $this->sell_price;
        $Object['sell_type'] = $this->sell_type;
        $Object['delete_reason'] = $this->delete_reason;
        $Object['is_active'] = $this->is_active;
        $Object['is_deleted'] = $this->is_deleted;
        $fav = false;
        if(auth()->check()){
            $fav = (Favourite::where('advertisement_id',$this->id)->where('user_id',auth()->user()->id)->first())?true:false;
        }
        $Object['is_fav'] = $fav;
        $Object['FirstMedia'] =new MediaResource($this->media()->first());
        $Object['created_at'] = Carbon::parse($this->created_at)->format('Y-m-d');
        $Object['Media'] = MediaResource::collection($this->media);
        $Object['Comments'] = CommentResource::collection($this->comments);
        return $Object;
    }

}
