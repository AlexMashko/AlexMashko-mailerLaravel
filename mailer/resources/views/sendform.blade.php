@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3 ">
            <a href="{{ url('/sended-messages') }}">Отправленные</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 ">
            <a href="{{ url('/sendform') }}">Полученые(не работает)</a>
        </div>
        <div class="col-md-9 ">
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(session('message'))
<div class="alert alert-success">
{{session('message')}}</div>
@endif
            <form class="form-horizontal" method="POST" action="{{url('/send-mail') }}">
                 {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">От кого</label>
                            <div class="col-md-6">
                                <input id="from" type="email" class="form-control" name="from" value="{{ Auth::user()->name }} <{{Auth::user()->email }}>" disabled>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Кому E-Mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="example@gmail.com" placeholder="example@gmail.com" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label for="subject" class="col-md-4 control-label" >Тема</label>

                            <div class="col-md-6">
                                <input id="subject" type="subject" class="form-control" name="subject" value="Новое предложение" required >
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-md-4 control-label">Сообщение</label>
                            <div class="col-md-6">
                                <textarea id="msg" type="text" rows="7" class="form-control" name="msg" placeholder="Введите Текст" value="asdas" >  
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Отправить сообщение
                                </button>
                            </div>
                        </div>

            </form>     
        </div>
    </div>
</div>
@endsection