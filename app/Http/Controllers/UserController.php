<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=DB::table('users')
            ->orderBy('updated_at','desc')
            ->paginate(10);

        return view ('user/index',array('users' => $users));
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
          'firstname' => 'required|alpha',
          'lastname' => 'required|alpha',
        'email' => 'required|email|unique:users',
        );

        $validator=Validator::make($request->all(),$rules);

        if ($validator->fails()){
            return Redirect::to('users')
                ->withErrors($validator)
                ->withInput();
        }
        else{
        $user=new User();
        $user->firstname = $request->firstname;
        $user->lastname=$request->lastname;
        $user->email=$request->email;

        $user->save();
        Session::flash('message','Successfully created user');
        return Redirect::to('users');
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
        $user=User::find($id);
        return view('user.update',array('user' => $user));
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
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|email|unique:users',
            ]);

            $user=User::find($id);
            $user->firstname=$request->firstname;
            $user->lastname=$request->lastname;
            $user->email=$request->email;

            $user->save();
            Session::flash('message','Successfully updated user');
            return Redirect::to('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();

        Session::flash('message','Successfully deleted user');
        return Redirect::to('users');
    }
}
