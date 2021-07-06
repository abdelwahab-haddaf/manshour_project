<?php

namespace App\Http\Requests\Web\Advertisement;

use App\Http\Resources\Web\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'advertisement_id'=>'required|exists:advertisements,id',
        ];
    }
    public function preset(){
        $Object = (new Advertisement())->find($this->advertisement_id);
        if($Object->sub_category_id_2){
            $SimilarAd = Advertisement::where('id','!=',$this->advertisement_id)->where('is_deleted',false)->where(function ($query) use ($Object){
                $query->where('sub_category_id_2',$Object->sub_category_id_2)
                    ->orWhere('sub_category_id_1',$Object->sub_category_id_1);
            })->get()->take(3);
        }else{
            $SimilarAd = Advertisement::where('id','!=',$this->advertisement_id)->where('is_deleted',false)->where(function ($query) use ($Object){
                $query->where('sub_category_id_1',$Object->sub_category_id_1)
                    ->orWhere('category_id',$Object->category_id);
            })->get()->take(3);
        }
        $Object = new AdvertisementResource($Object);
        return view('Web.Advertisement.show',compact('Object','SimilarAd'));
    }
}
