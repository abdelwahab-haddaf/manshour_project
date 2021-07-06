<?php

namespace App\Http\Controllers\Web;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        if(session('localization','ar') =='ar'){
            session(['localization' => 'ar']);
            App::setLocale('ar');
        }else{
            session(['localization' => 'en']);
            App::setLocale('en');
        }
    }
}
