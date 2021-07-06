<?php

namespace App\Http\Controllers\Admin\AppData;

use App\Http\Controllers\Admin\Controller;
use App\Models\AbuseReport;
use App\Models\Faq;
use App\Models\Setting;
use App\Traits\AhmedPanelTrait;

class AbuseReportController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('admin/app_data/abuse_types');
        $this->setEntity(new AbuseReport());
        $this->setTable('abuse_reports');
        $this->setLang('AbuseReport');
        $this->setColumns([
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
        ]);
        $this->setFields([
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
        ]);
        $this->SetLinks([
            'edit',
            'delete',
        ]);
    }

}
