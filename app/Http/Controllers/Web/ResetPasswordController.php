<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    public function setNewPassword(Request $request){

        $request->validate([
            'password'=>'required|confirmed|min:6',
            'password_confirmation'=>'required|min:6',
            'verification_code'=>'required|numeric'
        ]);

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
                return 'error 1';
//                return back()->with('error',__('auth.password_not_matched'));
            }
        }
        else {
            return 'error 2';
//            return back()->with('error',__('auth.code_not_correct'));
        }

    }
}
