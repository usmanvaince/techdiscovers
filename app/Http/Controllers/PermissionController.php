<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Permission;
use Illuminate\Support\Facades\Session;
class PermissionController extends Controller
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
        $permissions = Permission::orderBy('id', 'DESC')->get();
        return view('Permission.Permissions')->with('permissions',$permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Permission.createPermission');
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
            'display_name' => 'required|unique:permissions|max:255',
            'name' => 'required|unique:permissions|max:255',
        ]);
        $permission = new Permission();
        $permission->display_name = $request->display_name;
        $permission->name = $request->name;
        if ( !empty( $request->description ) ){

         $permission->description = $request->description;

        }
        $permission->save();
        Session::flash('flash_message', ' Permissions  successfully added!');
        return redirect('/permissions');
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
        $permission = Permission::findOrfail( $id );
        return view('Permission.editPermission')->with('permission', $permission);
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
            'display_name' => 'required||max:255|unique:permissions,display_name,'. $id,
            'name' => 'required|max:255|unique:permissions,name,'. $id
        ]);
        $permission = Permission::findOrfail( $id );
        $permission->display_name = $request->display_name;
        $permission->name = $request->name;
        if ( !empty( $request->description ) ){

            $permission->description = $request->description;

        }
        $permission->save();
        Session::flash('flash_message', ' Permissions  successfully updated!');
        return redirect('/permissions');
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
