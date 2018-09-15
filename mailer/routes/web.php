<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('dashboard', ['middleware' => 'auth', function() {
    return 'Добро пожаловать, '.Auth::user()->name.'!';
}]); 
Route::get('/sendform', function () {//форма для отправки сообщений
    return view('sendform');
});
Route::resource('/sended-messages', 'SendedMessagesController');//архив отправленых сообщений
Route::post('/send-mail','MailSetting@send_form')->name('home');//вид письма
Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');//маршрут, по которому будет осуществляться сверка ключа (token) из пользовательской ссылки и ключа в БД.





