<?php

namespace App\Http\Requests\Admin\AppData\Setting;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFieldsRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
    public function preset($crud){
        $facebook = Setting::where('key','facebook')->first();
        $facebook->setValue($this->filled('facebook')?$this->facebook:'');
        $facebook->save();
        $instagram = Setting::where('key','instagram')->first();
        $instagram->setValue($this->filled('instagram')?$this->instagram:'');
        $instagram->save();
        $instagram = Setting::where('key','twitter')->first();
        $instagram->setValue($this->filled('twitter')?$this->twitter:'');
        $instagram->save();
        $email = Setting::where('key','email')->first();
        $email->setValue($this->filled('email')?$this->email:'');
        $email->save();
        $mobile = Setting::where('key','mobile')->first();
        $mobile->setValue($this->filled('mobile')?$this->mobile:'');
        $mobile->save();
        $mobile = Setting::where('key','footer_about_us')->first();
        $mobile->setValue($this->filled('footer_about_us')?$this->footer_about_us:'');
        $mobile->save();
        return redirect($crud->getRedirect())->with('status', __('admin.messages.saved_successfully'));
    }
}
