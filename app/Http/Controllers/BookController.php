<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=DB::table('books')
            ->orderBy('updated_at','desc')
            ->paginate(10);

        return view ('book.index',array('books' => $books));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=array(
            'title' => 'required',
            'author' => 'required|alpha',
            'year' => 'required|numeric|max:2016|min:1000',
            'genre' => 'required|alpha',
        );

        $validator=Validator::make($request->all(),$rules);

        if ($validator->fails()){
            return Redirect::to('books')
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $book=new Book();
            $book->title = $request->title;
            $book->author= $request->author;
            $book->year= $request->year;
            $book->genre= $request->genre;

            $book->save();
            Session::flash('message','Successfully created book');
            return Redirect::to('books');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book=Book::find($id);
        return view('book.update',array('book' => $book));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'author' => 'required|alpha',
            'year' => 'required|numeric|max:2016|min:1000',
            'genre' => 'required|alpha',
        ]);

        $book=Book::find($id);
        $book->title = $request->title;
        $book->author= $request->author;
        $book->year= $request->year;
        $book->genre= $request->genre;

        $book->save();
        Session::flash('message','Successfully updated book');
        return Redirect::to('books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book=Book::find($id);
        $book->delete();

        Session::flash('message','Successfully deleted book');
        return Redirect::to('books');
    }
}
