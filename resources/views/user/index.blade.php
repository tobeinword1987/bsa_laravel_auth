<?php
/* @var $user app\User */
use App\Book;
?>

@extends('app')

@section('pageTitle')
    User List
@stop

@section('content')

    {!! HTML::ul($errors->all()) !!}

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {!! Form::open(array('url'=>'users')) !!}
    <div class="form-group">
        {!! Form::label('firstname','Enter firstname') !!}
        {!! Form::text('firstname',Input::old('firstname'),array('class'=>'form-control'))!!}
    </div>

    <div class="form-group">
        {!! Form::label('lastname','Enter lastname') !!}
        {!! Form::text('lastname',Input::old('lastname'),array('class'=>'form-control'))!!}
    </div>

    <div class="form-group">
        {!! Form::label('email','Enter email') !!}
        {!! Form::text('email',Input::old('email'),array('class'=>'form-control'))!!}
    </div>

    {!! Form::submit('Save', array('class'=>'btn btn-primary','style' => 'margin-bottom:10px')) !!}

    {!! Form::close() !!}

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <td>ID</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>email</td>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->firstname}}</td>
                    <td>{{$user->lastname}}</td>
                    <td>{{$user->email}}</td>
                    <td width="380">
                        <a class="btn btn-sm btn-success" href="{{ URL::to('users',$user->id) }}">Update</a>
                        <a class="btn btn-sm btn-info" href="{{ URL::to('users',$user->id) }}">Info</a>
                        @if(\App\Book::where('user_id', $user->id)->first()==null)
                            {!! Form::open(array('url' => 'users/'.$user->id, 'class' => 'pull-right','method' => 'DELETE')) !!}
                            {!! Form::hidden('method','DELETE') !!}
                            {!! Form::submit('Delete',array('class' => 'btn-warning')) !!}
                            {!! Form::close() !!}
{{--                        <a class="btn btn-sm btn-warning" href="{{ URL::to('users/',$user->id) }}">Delete</a>--}}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $users->render() !!}
@stop