<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\SendedMessages;
use Illuminate\Database\Eloquent\Model;

class SendedMessagesController extends Controller
{
    	public function index() 
    {
    	 $messages = DB::table('sended_messages')->get()->where('from_user_id', Auth::user()->email );
	    // Запрос к БД
	    return view('mails.sendedmessages', ['messages' => $messages]);

    }

    public function show()
  	{

  	}

    public function destroy()
    {
        //
    }

    public function store(Request $request) {
    	
    	$ArrMsgForDelete= $request->ArrMsgForDelete;
    	
    	if (isset($ArrMsgForDelete)) {
    		foreach ($ArrMsgForDelete as $key => $id) {
	    		DB::table('sended_messages')->where('from_user_id', Auth::user()->email )->delete($id);
	    	}


	    	echo 'Выбраные сообщения успешно удалены!';
    	}
    	else{
			echo 'Вы не выбрали ни одного сообщения!';
    	}
    	
    	$messages = DB::table('sended_messages')->get()->where('from_user_id', Auth::user()->email );
    	
        return view('mails.sendedmessages', ['messages' => $messages]);
    }
}
