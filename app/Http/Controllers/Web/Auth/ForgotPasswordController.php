<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Functions;
use App\Http\Controllers\Web\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use MongoDB\Driver\Session;
use phpseclib\Crypt\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    /**
     * Display the form to request a password reset link.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('Web.auth.forget_password');
    }
    /**
     * Validate the email for the given request.
     *
     * @param Request $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(['mobile' => 'required|exists:users,mobile']);
    }

    /**
     * Get the needed authentication credentials from the request.
     *
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request): array
    {
        return $request->only('mobile');
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param Request $request
     * @param string $response
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    protected function sendResetLinkFailedResponse(Request $request, string $response): RedirectResponse
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'mobile' => [trans($response)],
            ]);
        }

        return back()
            ->withInput($request->only('mobile'))
            ->withErrors(['mobile' => trans($response)]);
    }


    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $User = User::where('mobile',$request->mobile)->first();
        try {
            Functions::SendForget($User);
//            return $this->sendResetLinkResponse($request, __('auth.code_sent'));
            $data = PasswordReset::where('user_id','=',$User->id)->orderBy('id','desc')->first();
//            dd($data);
            return \view('Web.auth.verifyMobileCode',compact('data'));

        }catch (\Exception $exception){
            return $this->sendResetLinkFailedResponse($request, $exception->getMessage());
        }
    }

    public function setNewPassword(Request $request){

//          $request->validate([
//            'password'=>'required|confirmed|min:6',
//            'password_confirmation'=>'required|min:6',
//            'verification_code'=>'required|numeric'
//            ]);

        $user = User::find($request->user_id);
        $data = PasswordReset::where('token','=',$request->token)->where('user_id','=',$request->user_id)->first();
        if ($request->verification_code == $data->code){

            if ($request->password == $request->password_confirmation){
                $user->update([
                   'password'=>\Illuminate\Support\Facades\Hash::make($request->password),
                ]);

                if (Auth::attempt(['mobile' => $user->mobile, 'password' => $request->password])) {
                    Auth::user();
                    if (Auth::check()) {
                        return redirect()->route('home');
                    }
                }
            }
            else {
                return \view('Web.auth.verifyMobileCode',compact('data'))->with('error',__('auth.password_not_matched'));;
            }
        }
        else {
            return \view('Web.auth.verifyMobileCode',compact('data'))->with('error',__('auth.code_not_correct'));

        }

    }





}
