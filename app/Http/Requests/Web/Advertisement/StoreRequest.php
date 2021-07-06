<?php

namespace App\Http\Requests\Web\Advertisement;

use App\Helpers\Constant;
use App\Models\Advertisement;
use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'=>'required|exists:categories,id',
            'sub_category_id_1'=>'required|exists:categories,id',
            'sub_category_id_2'=>'sometimes|exists:categories,id',
            'city_id'=>'required|exists:cities,id',
            'contact'=>'required',
            'hide_contact'=>'sometimes',
            'title'=>'required',
            'details'=>'required',
            'has_price'=>'required|numeric',
            'price'=>'required_if:has_price,1',
            'media'=>'required',
            'media.*'=>'mimes:jpeg,jpg,png'
        ];
    }
    public function preset(){
        $Object = new Advertisement();
        $Object->setUserId(auth()->user()->getId());
        $Object->setCategoryId($this->category_id);
        $Object->setSubCategoryId1($this->sub_category_id_1);
        if($this->filled('sub_category_id_2')){
            $Object->setSubCategoryId2($this->sub_category_id_2);
        }
        $Object->setCityId($this->city_id);
        $Object->setContact($this->contact);
        if ($this->filled('hide_contact') && $this->hide_contact) {
            $Object->setHideContact(true);
        }else{
            $Object->setHideContact(false);
        }
        $Object->setTitle($this->title);
        $Object->setContent($this->details);
        if($this->has_price){
            $Object->setPrice($this->price);
        }
        $Object->save();
        $Object->refresh();
        foreach ($this->file('media') as $media) {
            $Media = new Media();
            $Media->setRefId($Object->getId());
            $Media->setMediaType(Constant::MEDIA_TYPES['Ad']);
            $Media->setFile($media);
            $Media->save();
        }
        return redirect('/');
    }
}
