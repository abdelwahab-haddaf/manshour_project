<?php

namespace App\Http\Requests\Web\Advertisement;

use App\Helpers\Constant;
use App\Models\Advertisement;
use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
            'delete_reason'=>'required|string|max:255',
            'sell_type'=>'required|in:'.Constant::ADVERTISEMENT_SELL_TYPE_RULES,
            'sell_price'=>'required|numeric',
        ];
    }
    public function preset(){
        $Object = (new Advertisement())->find($this->advertisement_id);
        $Object->setDeleteReason($this->delete_reason);
        $Object->setSellType($this->sell_type);
        $Object->setSellPrice($this->sell_price);
        $Object->setIsDeleted(true);
        $Object->save();
        return redirect()->back();
    }
}
