<?php

namespace App\Http\Controllers\Web;


use App\Http\Requests\Web\Home\ContactRequest;
use App\Http\Requests\Web\Home\IndexRequest;
use App\Models\Notification;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * @param IndexRequest $request
     * @return Application|Factory|View
     */
    public function index(IndexRequest $request){
        return $request->preset();
    }

    /**
     * @return Application|Factory|View
     */
    public function faq(){
        return view('Web.faq');
    }
    /**
     * @return Application|Factory|View
     */
    public function contact_us(){
        return view('Web.contact_us');
    }

    /**
     * @param ContactRequest $request
     * @return Application|Factory|View
     */
    public function post_contact_us(ContactRequest $request){
        return $request->preset();
    }

    /**
     * @return Application|Factory|View
     */
    public function privacy(){
        $Privacy = Setting::where('key','privacy')->first();
        if (!$Privacy) {
            return redirect('/');
        }
        return view('Web.privacy',compact('Privacy'));
    }
    /**
     * @return Application|Factory|View
     */
    public function about(){
        $About = Setting::where('key','about')->first();
        if (!$About) {
            return redirect('/');
        }
        return view('Web.about',compact('About'));
    }
    /**
     * @return Application|Factory|View
     */
    public function terms(){
        $Term = Setting::where('key','terms')->first();
        if (!$Term) {
            return redirect('/');
        }
        return view('Web.terms',compact('Term'));
    }
    /**
     * @return Application|Factory|View
     */
    public function commission(){
        $Commission = Setting::where('key','commission')->first();
        if (!$Commission) {
            return redirect('/');
        }
        return view('Web.commission',compact('Commission'));
    }

    /**
     * @return RedirectResponse
     */
    public function lang(){
        if(session('localization','en') =='en'){
            session(['localization' => 'ar']);
        }else{
            session(['localization' => 'en']);
        }
        App::setLocale(session('localization'));
        return redirect()->back();
    }
}
