<?php
/* @var $book app\Book */
use App\Book;
?>

@extends('app')

@section('pagetitle')
    Book List
@stop

@section('content')

    {!! HTML::ul($errors->all()) !!}

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @can('admin') <!-- проверяем права -->

        {!! Form::open(array('url'=>'books')) !!}
        <div class="form-group">
            {!! Form::label('title','Enter title') !!}
            {!! Form::text('title',Input::old('title'),array('class'=>'form-control'))!!}
        </div>

        <div class="form-group">
            {!! Form::label('author','Enter author') !!}
            {!! Form::text('author',Input::old('author'),array('class'=>'form-control'))!!}
        </div>

        <div class="form-group">
            {!! Form::label('year','Enter year') !!}
            {!! Form::text('year',Input::old('year'),array('class'=>'form-control'))!!}
        </div>

        <div class="form-group">
            {!! Form::label('genre','Enter genre') !!}
            {!! Form::text('genre',Input::old('genre'),array('class'=>'form-control'))!!}
        </div>

        {!! Form::submit('Save', array('class'=>'btn btn-primary','style' => 'margin-bottom:10px')) !!}

        {!! Form::close() !!}

    @endcan

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Author</td>
            <td>Year</td>
            <td>Genre</td>
            <td>Reader</td>
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
                    <td>{{DB::table('books')->where('id','=',$book->id)->whereNull('user_id')->count()>0?'':
                        Book::with('user')->where('id','=',$book->id)->first()->user->firstname." ".
                        Book::with('user')->where('id','=',$book->id)->first()->user->lastname}}</td>
                    @can('admin') <!-- проверяем права -->
                        <td width="380">
                            <a class="btn btn-sm btn-success" href="{{ URL::to('books',$book->id) }}">Update</a>

                            @if(DB::table('books')->where('id','=',$book->id)->whereNull('user_id')->count()>0)
                                {!! Form::open(array('url' => 'books/'.$book->id, 'class' => 'pull-right','method' => 'DELETE')) !!}
                                {!! Form::hidden('method','DELETE') !!}
                                {!! Form::submit('Delete',array('class' => 'btn-warning')) !!}
                                {!! Form::close() !!}
                            @endif
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $books->render() !!}
@stop