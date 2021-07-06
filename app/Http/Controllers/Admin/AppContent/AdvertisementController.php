<?php

namespace App\Http\Controllers\Admin\AppContent;

use App\Http\Controllers\Admin\Controller;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use App\Traits\AhmedPanelTrait;

class AdvertisementController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('admin/app_content/advertisements');
        $this->setEntity(new Advertisement());
        $this->setFilters([
            'is_deleted'=>[
                'name'=>'is_deleted',
                'type'=>'where',
                'value'=>false
            ]
        ]);
        $this->setViewCreate('Admin.AppContent.Advertisement.show');
        $this->setTable('advertisements');
        $this->setLang('Advertisement');
        $this->setCreate(false);
        $this->setColumns([
            'user_id'=> [
                'name'=>'user_id',
                'type'=>'relation',
                'relation'=>[
                    'data'=> User::all(),
                    'name'=>'name',
                    'entity'=>'user'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'category_id'=> [
                'name'=>'category_id',
                'type'=>'relation',
                'relation'=>[
                    'data'=> Category::all(),
                    'name'=>(session('my_locale')=='ar')?'name_ar':'name',
                    'entity'=>'category'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'city_id'=> [
                'name'=>'city_id',
                'type'=>'relation',
                'relation'=>[
                    'data'=> City::all(),
                    'name'=>(session('my_locale')=='ar')?'name_ar':'name',
                    'entity'=>'city'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'title'=> [
                'name'=>'title',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'price'=> [
                'name'=>'price',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'contact'=> [
                'name'=>'contact',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'hide_contact'=> [
                'name'=>'hide_contact',
                'type'=>'boolean',
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->SetLinks([
            'view',
            'delete',
        ]);
    }

}
