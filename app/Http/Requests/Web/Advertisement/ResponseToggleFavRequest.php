<?php

namespace App\Http\Requests\Web\Advertisement;

use App\Models\Advertisement;
use App\Models\Favourite;
use \App\Helpers\ResponseRequest as Response;

class ResponseToggleFavRequest extends Response
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'advertisement_id'=>'sometimes|exists:advertisements,id',
        ];
    }
    public function preset(){
        $Object = (new Advertisement())->find($this->advertisement_id);
        $Fav = Favourite::where('advertisement_id',$Object->getId())->where('user_id',auth()->user()->id)->first();
        if($Fav){
            $Fav->delete();
            $Fav = false;
        }else{
            $Fav = new Favourite();
            $Fav->setAdvertisementId($Object->getId());
            $Fav->setUserId(auth()->user()->id);
            $Fav->save();
            $Fav = true;
        }
        return $this->successJsonResponse([],$Fav);
    }
}
