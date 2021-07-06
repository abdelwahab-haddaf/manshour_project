<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Controllers\Web\Controller;
use App\Models\VerifyAccounts;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    /**
     * Show the email verification notice.
     *
     * @param Request $request
     * @return Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse|View
     */
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('Web.auth.verify');
    }
    public function check_verify(Request $request): RedirectResponse
    {
        $request->validate(['code' => 'required']);
        $logged = auth()->user();
        $verify = VerifyAccounts::where('user_id',$logged->id)->first();
        if($request->code != $verify->code)
            return back()
                ->withInput($request->only('code'))
                ->withErrors(['mobile' => __('auth.failed')]);
        $logged->mobile_verified_at = now();
        $logged->email_verified_at = now();
        $logged->save();
        return back()->with('status', trans('auth.verified'));
    }
    public function resend_verification(){
        $logged = auth()->user();
        Functions::SendVerification($logged,Constant::VERIFICATION_TYPE['Mobile']);
        return back()->with('resent', trans('auth.verification_code_sent'));
    }
}
