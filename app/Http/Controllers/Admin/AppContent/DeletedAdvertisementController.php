<?php

namespace App\Http\Controllers\Admin\AppContent;

use App\Helpers\Constant;
use App\Http\Controllers\Admin\Controller;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use App\Traits\AhmedPanelTrait;

class DeletedAdvertisementController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('admin/app_content/deleted_advertisements');
        $this->setEntity(new Advertisement());
        $this->setFilters([
            'is_deleted'=>[
                'name'=>'is_deleted',
                'type'=>'where',
                'value'=>true
            ]
        ]);
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
            'sell_price'=> [
                'name'=>'sell_price',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'delete_reason'=> [
                'name'=>'delete_reason',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'sell_type'=> [
                'name'=>'sell_type',
                'type'=>'select',
                'data'=>[
                    Constant::ADVERTISEMENT_SELL_TYPE['InsideWebsite'] =>__('crud.Advertisement.SellType.'.Constant::ADVERTISEMENT_SELL_TYPE['InsideWebsite'],[],session('my_locale')),
                    Constant::ADVERTISEMENT_SELL_TYPE['OutsideWebsite'] =>__('crud.Advertisement.SellType.'.Constant::ADVERTISEMENT_SELL_TYPE['OutsideWebsite'],[],session('my_locale')),
                    Constant::ADVERTISEMENT_SELL_TYPE['NeverSell'] =>__('crud.Advertisement.SellType.'.Constant::ADVERTISEMENT_SELL_TYPE['NeverSell'],[],session('my_locale')),
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->SetLinks([
            'delete',
        ]);
    }

}
