<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;



class CategoryController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    // show categories DataTable
    public function index() {
        $query = Category::query();
        DB::statement(DB::raw('set @rownum=0'));
        $query->select('categories.*',DB::raw('@rownum  := @rownum  + 1 AS rownum'));
        $dt = DataTables::eloquent( $query );
        $dt->addColumn('action', function ($data) {
            return '<div class="action">
                        <button class="btn btn-primary" ng-click="editCategory('.$data->id.')" >Edit</button>
                        <button class="btn btn-danger" ng-click="deleteCategory('.$data->id.')"> Delete </button>
                    </div>';
        });

        $dt->rawColumns(['id','action','name','rownum','slug_category']);
        return $dt->make(true);

    }
    public function store(Request $request)
    {
        if( $request->input('type') === 'addCategory'  ) {
            $category = new Category();
        }
        else {
            $category = ( new Category() )->find($request->input('id'));
        }
        $category->name =  $request->input('name');
        $category->slug_category = str_slug( $request->input('name'), '-');
        $category->save();
        return $category->id;
    }

    public function edit( Request $request )
    {
       $category = ( new Category())->find( $request->input('id') );
       if( $category ) {
           return response()->json( $category );
       }
       return response()->json('category not found', 400);
    }
    public function destroy( Request $request )
    {
       $category = ( new Category() )->where('id','=', $request->input('id'))
                                     ->delete();

    }
}
