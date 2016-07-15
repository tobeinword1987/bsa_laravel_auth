<?php
/* @var $book app\Book */
use App\Book;
?>

@extends('app')

@section('pagetitle')
    User's Info
@stop

@section('content')

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Author</td>
            <td>Year</td>
            <td>Genre</td>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{$book->id}}</td>
                <td>{{$book->title}}</td>
                <td>{{$book->author}}</td>
                <td>{{$book->year}}</td>
                <td>{{$book->genre}}</td>
                <td width="380">
                    @if($book->firstname==null)
                        {!! Form::open(array('url' => 'users/getbook/'.$book->id.'/'.$user->id, 'class' => 'pull-right','method' => 'PUT')) !!}
                        {!! Form::hidden('method','PUT') !!}
                        {!! Form::submit('Get',array('class' => 'btn-success')) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(array('url' => 'users/turnbook/'.$book->id, 'class' => 'pull-right','method' => 'PUT')) !!}
                        {!! Form::hidden('method','PUT') !!}
                        {!! Form::submit('Turn in',array('class' => 'btn-warning')) !!}
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $books->render() !!}
@stop