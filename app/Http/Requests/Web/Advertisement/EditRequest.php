<?php

namespace App\Http\Requests\Web\Advertisement;

use App\Models\Advertisement;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
        return view('Web.Advertisement.edit',compact('Object'));
    }
}
