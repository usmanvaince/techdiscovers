<?php

namespace App\Http\Controllers;

use App\Category;
use App\Role;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $superAdmin = User::whereRoleIs('superadministrator')->first();
        if( !$superAdmin ) {
            $superAdmin = 0;
        }
        $ownId =  Auth::user()->id;
        $users = User::where('id','!=', $superAdmin->id)
                     ->where('id','!=',$ownId)
                     ->get();
        return view('Users.Users')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {




    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = 1;
        $user->password =  bcrypt( $request->password );
        $user->department_id = (int)$request->department_id;
        $user->save();
        $role = (  new Role())->findOrFail(2);
        $user->attachRole( $role );
        Session::flash('flash_message', 'user successfully added!');
        return Redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['departments'] = (new Category())->all();
        $data['user'] =(new User)->findOrFail( $id );
        return view('Users.editUser', $data);

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'. $id,
        ]);

        $user = ( new User())->findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  bcrypt( $request->password );
        $user->department_id = (int)$request->department_id;
        $user->save();
        Session::flash('flash_message', 'user updated');
        return Redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        Session::flash('flash_message', 'user successfully Deleted!');
        return Redirect()->route('users.index');
    }
}
