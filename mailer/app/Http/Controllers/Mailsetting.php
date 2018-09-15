<?php

namespace App\Http\Controllers;

use App\Mail\MailClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\User;
use Illuminate\Support\Facades\Auth;

class Mailsetting extends Controller
{
    
    public function send_form(Request $request)
    {

    	
    	$to_email = $request->email;
    	$subject = $request->subject;
    	$msg = $request->msg;
        $from_email = $request->from;
        $from_user_id=Auth::user()->email ;
        $from_name = $request->name;//
        $headers = "From:".$from_name."<".$from_email.">\r\n". 
               "MIME-Version: 1.0" . "\r\n" . 
               "Content-type: text/html; charset=UTF-8" . "\r\n"; 


        if(mail($to_email, $subject,$msg, $headers )) {
            echo "Сообщение успешно отправленно!";
            Mail::to($to_email)->send(new MailClass($to_email, $subject, $msg, $headers ));   
            DB::insert('insert into sended_messages (subject, to_email, message, from_user_id) VALUES (:subject, :to_email, :msg, :from_user_id)', [$subject,$to_email,$msg,$from_user_id]);
        }
        else{
            echo "Сообщение не отправленно, вы допустили ошибку!";
        }

        


        
        return view('sendform')->with('message','Add!');
    }
}
