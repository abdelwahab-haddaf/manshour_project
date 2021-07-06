<?php

namespace App\Http\Controllers\Admin\AppData;

use App\Http\Controllers\Admin\Controller;
use App\Models\Banner;
use App\Traits\AhmedPanelTrait;

class BannerController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('admin/app_data/banners');
        $this->setEntity(new Banner());
        $this->setTable('banners');
        $this->setLang('Banner');
        $this->setColumns([
            'image'=> [
                'name'=>'image',
                'type'=>'image',
                'is_searchable'=>false,
                'order'=>false
            ],
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'url'=> [
                'name'=>'url',
                'type'=>'url',
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
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_required'=>true
            ],
            'url'=> [
                'name'=>'url',
                'type'=>'url',
                'is_required'=>true
            ],
            'image'=> [
                'name'=>'image',
                'type'=>'image',
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
