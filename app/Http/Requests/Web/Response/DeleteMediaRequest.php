<?php

namespace App\Http\Requests\Web\Response;

use App\Helpers\ResponseRequest;
use App\Http\Resources\Web\CategoryResource;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;

class DeleteMediaRequest extends ResponseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'media_id'=>'required|exists:media,id',
        ];
    }
    public function preset(){
        $Object = (new Media())->find($this->media_id);
        $Object->delete();
        return $this->successJsonResponse([]);
    }
}
