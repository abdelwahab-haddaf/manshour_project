<?php


namespace App\Helpers;


use App\Models\Notification;
use App\Models\PasswordReset;
use App\Models\VerifyAccounts;
use App\Notifications\PasswordReset as PasswordResetNotification;
use App\Notifications\VerifyAccount;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
class Functions
{
    use ResponseTrait;
    public static function SendNotification($user,$title,$msg,$title_ar,$msg_ar,$ref_id = null,$type= 0,$store = true,$replace =[])
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $registrationIds = $user->device_token;

        $message = array
        (
            'body'  => ($user->getAppLocale() == 'en')?$msg:$msg_ar,
            'title' => ($user->getAppLocale() == 'en')?$title:$title_ar,
            'sound' => true,
        );
        $extraNotificationData = ["ref_id" =>$ref_id,"type"=>$type];
        $fields = array
        (
            'to'        => $registrationIds,
            'notification'  => $message,
            'data' => $extraNotificationData
        );
        $headers = array
        (
            'Authorization: key='.config('app.notification_key') ,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        if($store){
            $notify = new Notification();
            $notify->setType($type);
            $notify->setUserId($user->id);
            $notify->setTitle($title);
            $notify->setMessage($msg);
            $notify->setTitleAr($title_ar);
            $notify->setMessageAr($msg_ar);
            $notify->setRefId(@$ref_id);
            $notify->save();
        }
        return true;
    }
    public static function SendNotifications($users,$title,$msg,$ref_id = null,$type= 0,$store = true,$replace =[])
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $registrationIds = [];
        foreach ($users as $user){
            $registrationIds[] = $user->device_token;

        }

        $message = array
        (
            'body'  => $msg,
            'title' => $title,
            'sound' => true,
        );
        $extraNotificationData = ["ref_id" =>$ref_id,"type"=>$type];
        $fields = array
        (
            'registration_ids' => $registrationIds,
            'notification' => $message,
            'data' => $extraNotificationData
        );
        $headers = array
        (
            'Authorization: key='.config('app.notification_key') ,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        if($store){
            foreach ($users as $user){
                $notify = new Notification();
                $notify->setType($type);
                $notify->setUserId($user->id);
                $notify->setTitle($title);
                $notify->setMessage($msg);
                $notify->setTitleAr($title);
                $notify->setMessageAr($msg);
                $notify->setRefId(@$ref_id);
                $notify->save();
            }
        }
        return true;
    }
    public static function SendSms($msg,$to){
        if (substr($to, 0, 1) == '0' ){
            $to = substr($to,1);
        }
        if( substr($to, 0, 3) == '966') {
            $to = substr($to,3);
        }
        $ch = curl_init();
        $userid = '966555408042';
        $password = 'Mnshur';
        $sender = 'MNSHUR';
        $text = urlencode($msg);
//        $encoding = 'UTF8';
        // auth call
        $url = "https://www.hisms.ws/api.php?send_sms&username={$userid}&password={$password}&numbers=966{$to}&message={$text}&sender={$sender}";
        $ret  = json_decode(file_get_contents($url), true);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    public static function SendVerification($user,$type = null){
        if($type != null){
            switch ($type){
                case Constant::VERIFICATION_TYPE['Email']:{
                    if($user->getEmailVerifiedAt() != null)
                        return (new Functions)->failJsonResponse([__('auth.verified_before')]);
                    $code_email = rand( 10000 , 99999 );
                    $token = Str::random(40).time();
                    VerifyAccounts::updateOrCreate(
                        ['user_id' => $user->getId(),'type'=>Constant::VERIFICATION_TYPE['Email']],
                        [
                            'user_id' => $user->getId(),
                            'code' => $code_email,
                            'token' => $token,
                            'type'=>Constant::VERIFICATION_TYPE['Email']
                        ]
                    );
                    $user->notify(
                        new VerifyAccount($token,$code_email)
                    );
                    break;
                }
                case Constant::VERIFICATION_TYPE['Mobile']:{
                    if($user->getMobileVerifiedAt() != null)
                        return (new Functions)->failJsonResponse([__('auth.mobile_verified_before')]);
                    $code_mobile = rand( 10000 , 99999 );
                    $token = Str::random(40).time();
                    VerifyAccounts::updateOrCreate(
                        ['user_id' => $user->getId(),'type'=>Constant::VERIFICATION_TYPE['Mobile']],
                        [
                            'user_id' => $user->getId(),
                            'code' => $code_mobile,
                            'token' => $token,
                            'type'=>Constant::VERIFICATION_TYPE['Mobile']
                        ]
                    );
                    static::SendSms('رمز تفعيل الحساب هو : '.$code_mobile,$user->getMobile());
                    break;
                }
            }
        }else{
            $code_email = rand( 10000 , 99999 );
            $code_mobile = rand( 10000 , 99999 );
            $token = Str::random(40).time();
            VerifyAccounts::updateOrCreate(
                ['user_id' => $user->getId(),'type'=>Constant::VERIFICATION_TYPE['Email']],
                [
                    'user_id' => $user->getId(),
                    'code' => $code_email,
                    'token' => $token,
                    'type'=>Constant::VERIFICATION_TYPE['Email']
                ]
            );
            VerifyAccounts::updateOrCreate(
                ['user_id' => $user->getId(),'type'=>Constant::VERIFICATION_TYPE['Mobile']],
                [
                    'user_id' => $user->getId(),
                    'code' => $code_mobile,
                    'token' => $token,
                    'type'=>Constant::VERIFICATION_TYPE['Mobile']
                ]
            );
            static::SendSms('رمز تفعيل الحساب هو : '.$code_mobile,$user->getMobile());
//            $user->notify(
//                new VerifyAccount($token,$code_email)
//            );
        }
        return (new Functions)->successJsonResponse( [__('auth.verification_code_sent')]);
    }
    public static function SendForget($user,$type = null){
        $code = rand( 10000 , 99999 );
        $token = Str::random(40).time();
        PasswordReset::updateOrCreate(
            ['user_id' => $user->getId()],
            [
                'user_id' => $user->getId(),
                'code' => $code,
                'token' => $token,
            ]
        );
        static::SendSms('رمز استرجاع كلمة المرور هو : '.$code,$user->getMobile());
//        $user->notify(
//            new PasswordResetNotification($code)
//        );
    }
    public static function StoreImage($attribute_name,$destination_path){
        $destination_path = "storage/".$destination_path.'/';
        $request = Request::instance();
        if ($request->hasFile($attribute_name)) {
            $request_file = $request->file($attribute_name);
            if ($request_file->isValid()) {
                $file = Image::make($request_file)->resize(850, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $watermark = Image::make('logo.png')->resize(200,null,function ($c){
                    $c->aspectRatio();
                });
                $file->insert($watermark,'bottom-right',10,15);
                $file_name = md5($request_file->getClientOriginalName().time()).'.'.$request_file->getClientOriginalExtension();
                $file->save($destination_path.$file_name);
                $attribute_value =  $destination_path.$file_name;
            }
        }
        return $attribute_value??null;
    }
    public static function StoreImageModel($file,$destination_path){
        $destination_path = "storage/".$destination_path.'/';
        if ($file->isValid()) {
            $image = Image::make($file)->resize(850, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $watermark = Image::make('logo.png')->resize(200,null,function ($c){
                $c->aspectRatio();
            });
            $image->insert($watermark,'bottom-right',10,15);
            $file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $image->save($destination_path.$file_name);
            $attribute_value =  $destination_path.$file_name;
        }
        return $attribute_value??null;
    }
}
