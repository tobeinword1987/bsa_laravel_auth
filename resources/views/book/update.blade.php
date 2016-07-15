<?php
/**
 * Created by PhpStorm.
 * Book: lyudmila
 * Date: 14.07.16
 * Time: 11:40
 */

use App\Book;
?>

@extends('app')

@section('pagetitle')
    Book edit
@stop

@section('content')

    {!! HTML::ul($errors->all()) !!}

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {!! Form::model($book,array('url'=>array('books',$book->id),'method' => 'PUT')) !!}

    <div class="form-group">
        {!! Form::label('title','Enter title') !!}
        {!! Form::text('title', $book->title,array('class'=>'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('author','Enter author') !!}
        {!! Form::text('author',$book->author,array('class'=>'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('year','Enter year') !!}
        {!! Form::text('year',$book->year,array('class'=>'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('genre','Enter genre') !!}
        {!! Form::text('genre',$book->genre,array('class'=>'form-control')) !!}
    </div>

    {!! Form::submit('Update', array('class'=>'btn btn-primary','style' => 'margin-bottom:10px')) !!}

    {!! Form::close() !!}
@stop