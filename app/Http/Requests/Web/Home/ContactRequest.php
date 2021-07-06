<?php

namespace App\Http\Requests\Web\Home;

use App\Helpers\Constant;
use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string',
            'email'=>'required|email',
            'mobile'=>'required',
            'type'=>'required|in:'.Constant::TICKETS_TYPE_RULES,
            'message'=>'required|string',
        ];
    }
    public function preset(){
        $Object = new Ticket();
        $Object->setName($this->name);
        $Object->setEmail($this->email);
        $Object->setMobile($this->mobile);
        $Object->setType($this->type);
        $Object->setMessage($this->message);
        $Object->save();
        return redirect('/');
    }
}
