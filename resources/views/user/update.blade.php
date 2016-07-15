<?php
/**
 * Created by PhpStorm.
 * User: lyudmila
 * Date: 14.07.16
 * Time: 11:40
 */

use App\Book;
?>

@extends('app')

@section('pageTitle')
    User edit
@stop

@section('content')

    {!! HTML::ul($errors->all()) !!}

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {!! Form::model($user,array('url'=>array('users',$user->id),'method' => 'PUT')) !!}
{{--    {!! Form::open(array('url'=>'users','method' => 'PUT')) !!}--}}

    <div class="form-group">
        {!! Form::label('firstname','Enter firstname') !!}
        {!! Form::text('firstname', Request::input('name'),array('class'=>'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('lastname','Enter lastname') !!}
        {!! Form::text('lastname',$user->lastname,array('class'=>'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email','Enter email') !!}
        {!! Form::text('email',$user->email,array('class'=>'form-control')) !!}
    </div>

    {!! Form::submit('Update', array('class'=>'btn btn-primary','style' => 'margin-bottom:10px')) !!}

    {!! Form::close() !!}
@stop