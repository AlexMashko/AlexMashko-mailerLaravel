<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sendedmessages extends Model
{
    protected $table='sended_messages'; //сдесь явно указывает с какой таблицей связана модель
    protected $fillable =['id', 'subject', 'to_email', 'message', 'from_user_id']; // указывает значения каких полей можно будет изменять в дальнейщем коде
 	protected $rules= [//устанавливаем правила для полей
     	'from_user_id'=>['required', 'max:32'],
     	'to_email'=>['required']
     ];


         public function store(request $request, $post) {
        
        }
    }
}
