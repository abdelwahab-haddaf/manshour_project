<?php

namespace App\Http\Requests\Web\Profile;

use App\Helpers\Constant;
use App\Models\Advertisement;
use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'city_id'=>'required|exists:cities,id',
            'mobile'=>'required|unique:users,mobile,'.auth()->user()->id,
        ];
    }
    public function preset(){
        $Object = auth()->user();
        $Object->setName($this->name);
        $Object->setEmail($this->email);
        $Object->setCityId($this->city_id);
        $Object->setMobile($this->mobile);
        $Object->save();
        return redirect('/');
    }
}
