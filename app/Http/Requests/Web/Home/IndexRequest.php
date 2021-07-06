<?php

namespace App\Http\Requests\Web\Home;

use App\Http\Resources\Web\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }
    public function preset(){
        $Objects = new Advertisement();
        if($this->filled('q')){
            $Objects = $Objects->where('title','LIKE','%'.$this->q.'%')->orWhere('content','LIKE','%'.$this->q.'%');
        }
        $Objects = $Objects->paginate(10);
        $Objects = AdvertisementResource::collection($Objects);
        return view('Web.index',compact('Objects'));
    }
}
