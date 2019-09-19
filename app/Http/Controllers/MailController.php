<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendReset($to, $home, $url)
    {
     Mail::send('auth.passwords.reset-template', ["url" => $url, "home" => $home], function ($message) use ($to){
         $message->to($to)->subject('Reset Password');
     });

        if (Mail::failures()) {
            return false;
        }else{
            return true;
        }
    }

    public static function sendVerifyMail($to, $home, $url)
    {
        Mail::send('auth.register.confirm_email', ["url" => $url, "home" => $home], function ($message) use ($to){
            $message->to($to)->subject('Verify Email');
        });

        if (Mail::failures()) {
            return false;
        }else{
            return true;
        }
    }
}
