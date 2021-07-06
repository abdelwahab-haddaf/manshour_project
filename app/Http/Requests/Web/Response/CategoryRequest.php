<?php

namespace App\Http\Requests\Web\Response;

use App\Helpers\ResponseRequest;
use App\Http\Resources\Web\CategoryResource;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends ResponseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'=>'required|exists:categories,id',
        ];
    }
    public function preset(){
        $Objects = new Category();
        $Objects = $Objects->where('parent_id',$this->category_id);
        $Objects = $Objects->get();
        return $this->successJsonResponse([],[
            'Categories'=>CategoryResource::collection($Objects),
            'Count'=>count($Objects)
        ]);
    }
}
