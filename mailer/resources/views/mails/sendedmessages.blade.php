@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-1 ">
            <a href="{{ url('/sendform') }}">Отправить</a><br>
            <a href="{{ url('/sendform') }}">Полученые</a>
        </div>
        <div class="col-md-9 ">
                <div class="col-md-12">
               {!! Form::open(['action' => 'SendedMessagesController@store']) !!}
                 <table  id="grid" class="table">  
                      <thead>
                        <tr>Отправленые сообщения:( {{$messages->count()}} ) </tr>
                        <tr>
                            <th>×</th>
                            <th class="sortedCollumn" data-type="string">Кому &#8659</th>
                            <th class="sortedCollumn" data-type="string">Тема &#8659</th>
                            <th class="sortedCollumn" data-type="string">Дата &#8659</th>
                            <th>Сообщение:</th>
                            
                        </tr>
                      </thead>
                      <tbody>
<?php $ArrMsgForDelete=[]; ?>                      
@foreach($messages as $msg)
                        <tr data-mesage-id="{{$msg->id}}">
                            <td ><input type="checkbox" name="ArrMsgForDelete[]" value="{{$msg->id}}" ></td> <!-- чекбоксы с ид сообщения которое нужно удалить -->
                            <td>{{$msg->to_email}}</td>
                            <td>{{str_limit($msg->subject, $limit = 20, $end = '...') }}</td> <!-- тема(20 символовы первых) -->
                            <td>{{date('d/m/Y', strtotime($msg->created_at))}}</td>
                            <td>
                              <ul>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                       {{str_limit($msg->message, $limit = 25, $end = '...')}}<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <p>
                                            {{str_limit($msg->message, $limit = 3000, $end = '...')}}
                                        </p>
                                    </ul>
                                </li>
                              </ul>
                            </td>
                        </tr>
@endforeach 
                      </tbody>
                      <input type="submit" class="btn-xs" name="formSubmit" value="Удалить Сообщения" />
                  {!! Form::close() !!}
                </table>
  


              
            </div>
        </div>
    </div>
</div>






@endsection



