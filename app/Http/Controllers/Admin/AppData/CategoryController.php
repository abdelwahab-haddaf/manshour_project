<?php

namespace App\Http\Controllers\Admin\AppData;

use App\Http\Controllers\Admin\Controller;
use App\Models\BankAccount;
use App\Models\Category;
use App\Models\City;
use App\Traits\AhmedPanelTrait;

class CategoryController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('admin/app_data/categories');
        $this->setEntity(new Category());
        $this->setTable('categories');
        $this->setLang('Category');
        $this->setColumns([
            'parent_id'=> [
                'name'=>'parent_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Category::all(),
                    'custom'=>function($Object){
                        return ($Object)?((app()->getLocale()=='ar')?$Object->name_ar:$Object->name):'-';
                    },
                    'entity'=>'parent'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'name_ar'=> [
                'name'=>'name_ar',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'is_active'=> [
                'name'=>'is_active',
                'type'=>'active',
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->setFields([
            'parent_id'=> [
                'name'=>'parent_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> function($Object) {
                        return ($Object)?Category::where('id','!=',$Object->getId())->get():Category::all();
                    },
                    'custom'=>function($Object){
                        return ($Object)?((app()->getLocale()=='ar')?$Object->name_ar:$Object->name):'-';
                    },
                    'entity'=>'parent'
                ],
                'is_required'=>false
            ],
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_required'=>true
            ],
            'name_ar'=> [
                'name'=>'name_ar',
                'type'=>'text',
                'is_required'=>true
            ],
            'is_active'=> [
                'name'=>'is_active',
                'type'=>'active',
                'is_required'=>true
            ],
        ]);
        $this->SetLinks([
            'edit',
            'delete',
        ]);
    }

}
