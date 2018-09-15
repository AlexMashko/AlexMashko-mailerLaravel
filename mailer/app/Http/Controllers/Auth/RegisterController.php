<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Mail::to($user)->send(new UserRegistered($user));
        $request->session()->flash('message', 'На ваш адрес было выслано письмо с подтверждением регистрации.');
        return back();
    } 

    public function confirmEmail(Request $request, $token)
    {
        User::whereToken($token)->firstOrFail()->confirmEmail();
        $request->session()->flash('message', 'Учетная запись подтверждена. Войдите под своим именем.');
        return redirect('login');
    }

    // public function postRegister(Request $request)
    // {
    //     $validator = $this->validator($request->all());
    //     if ($validator->fails()) {          
    //         throwValidationException($request, $validator);
    //     };
    //     $user = $this->create($request->all());
    //     //создаем код и записываем код
    //     $code = CodeController::generateCode(8);
    //     Code::create([
    //         'user_id' => $user->id,
    //         'code' => $code,
    //     ]);
    //     //Генерируем ссылку и отправляем письмо на указанный адрес
    //     $url = url('/').'/auth/activate?id='.$user->id.'&code='.$code;      
    //     Mail::send('emails.registration', array('url' => $url), function($message) use ($request)
    //     {          
    //         $message->to($request->email)->subject('Registration');
    //     });
        
    //     return 'Регистрация прошла успешно, на Ваш email отправлено письмо со ссылкой для активации аккаунта';
    // }


    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


}
