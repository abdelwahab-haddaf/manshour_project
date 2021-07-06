<?php

namespace App\Http\Controllers\Web;


use App\Http\Requests\Web\Home\ContactRequest;
use App\Http\Requests\Web\Home\IndexRequest;
use App\Http\Requests\Web\Profile\UpdateRequest;
use App\Models\Advertisement;
use App\Models\Favourite;
use App\Models\Notification;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class ProfileController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function update(){
        return view('Web.Profile.update_profile');
    }

    /**
     * @return Application|Factory|View
     */
    public function favourite(){
        $Fav = Favourite::where('user_id',auth()->user()->id)->pluck('advertisement_id');
        $Objects = Advertisement::whereIn('id',$Fav)->paginate(10);
        return view('Web.Profile.favourite',compact('Objects'));
    }

    /**
     * @param UpdateRequest $request
     * @return Application|Factory|View
     */
    public function post_update(UpdateRequest $request){
        return $request->preset();
    }

    /**
     * @return Application|Factory|View
     */
    public function my_advertisements(){
        $Advertisements = \App\Models\Advertisement::where('user_id',auth()->user()->id)->where('is_deleted',false)->paginate(10);
        return view('Web.Profile.my_advertisements',compact('Advertisements'));
    }

    /**
     * @return Application|Factory|View
     */
    public function notifications(){
        $Objects = Notification::where('user_id',auth()->user()->id)->paginate(10);
        return view('Web.notifications',compact('Objects'));
    }
}
