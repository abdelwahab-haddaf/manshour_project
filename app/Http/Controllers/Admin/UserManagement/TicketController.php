<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Helpers\Constant;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\UserManagement\Ticket\CloseRequest;
use App\Models\Ticket;
use App\Traits\AhmedPanelTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class TicketController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('admin/user_managements/tickets');
        $this->setEntity(new Ticket());
        $this->setCreate(false);
        $this->setExport(true);
        $this->setTable('tickets');
        $this->setLang('Ticket');
        $this->setColumns([
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'email'=> [
                'name'=>'email',
                'type'=>'email',
                'is_searchable'=>true,
                'order'=>true
            ],
            'mobile'=> [
                'name'=>'mobile',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'message'=> [
                'name'=>'message',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'type'=> [
                'name'=>'type',
                'type'=>'select',
                'data'=>[
                    Constant::TICKETS_TYPE['Complain'] =>__('crud.Ticket.Types.'.Constant::TICKETS_TYPE['Complain'],[],session('my_locale')),
                    Constant::TICKETS_TYPE['Suggestion'] =>__('crud.Ticket.Types.'.Constant::TICKETS_TYPE['Suggestion'],[],session('my_locale')),
                    Constant::TICKETS_TYPE['Enquiry'] =>__('crud.Ticket.Types.'.Constant::TICKETS_TYPE['Enquiry'],[],session('my_locale')),
                    Constant::TICKETS_TYPE['Others'] =>__('crud.Ticket.Types.'.Constant::TICKETS_TYPE['Others'],[],session('my_locale')),
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'status'=> [
                'name'=>'status',
                'type'=>'select',
                'data'=>[
                    Constant::TICKETS_STATUS['Open'] =>__('crud.Ticket.Statuses.'.Constant::TICKETS_STATUS['Open'],[],session('my_locale')),
                    Constant::TICKETS_STATUS['Closed'] =>__('crud.Ticket.Statuses.'.Constant::TICKETS_STATUS['Closed'],[],session('my_locale')),
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->SetLinks([
            'close'=>[
                'route'=>'close',
                'icon'=>'fa-window-close',
                'lang'=>__('crud.Ticket.Links.close'),
                'condition'=>function ($Object){
                    return ($Object->getStatus() == Constant::TICKETS_STATUS['Open']);
                }
            ],
        ]);
    }

    /**
     * @param CloseRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function close(CloseRequest $request, $id){
        return $request->preset($this,$id);
    }
}
