<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use App\Role;
use Session;

class RoleController extends Controller
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
        $roles = Role::where('name','!=','superadministrator')
                     ->orderBy('id','ASC')
                     ->get();
        return view('Role.Role')->with('roles',$roles);
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
        //
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
      $data['role'] = Role::where('id', $id)
                          ->with('permissions')->first();
      $data['permissions'] = Permission::all();
      return view('Role.editRole', $data);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'display_name' => 'required|max:255|unique:roles,display_name,'. $id,
            'description' => 'required|max:255',
        ]);
        $role =Role::findOrfail( $id );
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        if( $request->permissions )
        {
            $role->syncPermissions(explode(',',$request->permissions) );
        }
        Session::flash('flash_message', ' Role successfully updated!');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
