<?php

namespace App\Http\Requests\Web\Advertisement;

use App\Http\Resources\Web\AdvertisementResource;
use App\Models\Advertisement;
use \App\Helpers\ResponseRequest as Response;

class ResponseRequest extends Response
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'=>'sometimes|exists:categories,id',
            'sub_category_id'=>'sometimes|exists:categories,id',
            'sub_sub_category_id'=>'sometimes|exists:categories,id',
        ];
    }
    public function preset(){
        $Objects = new Advertisement();
        $Objects = $Objects->where('is_deleted',false);
        if($this->filled('category_id')){
            $Objects = $Objects->where('category_id',$this->category_id);
        }
        if($this->filled('sub_category_id')){
            $Objects = $Objects->where('sub_category_id_1',$this->sub_category_id);
        }
        if($this->filled('sub_sub_category_id')){
            $Objects = $Objects->where('sub_category_id_2',$this->sub_sub_category_id);
        }

        if($this->filled('q')){
            $Objects = $Objects->where('title','LIKE','%'.$this->q.'%')->orWhere('content','LIKE','%'.$this->q.'%');
        }
        $Objects = AdvertisementResource::collection($Objects->paginate(10));
        return $this->successJsonResponse([],$Objects->items(),'Advertisements',$Objects);
    }
}
