<?php

namespace App\Http\Controllers;
use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getBlogCategories()
    {
        return Category::orderBy('id', 'DESC')->get();
    }
    public function posts( Request $request ) {
       $posts = DB::table('posts')
                    ->join('users', 'posts.user_id', '=', 'users.id')
                    ->select('posts.*', 'users.name')
                    ->get();
       return response()->json($posts);

    }

    public function createBlogPost(Request $request)
    {
        if ( !$request->has('category') ) {
            return response()->json('category is required', 400);
        }
        if (!$request->has('title')) {
            return response()->json('Post Title is required', 400);
        }
        if (!$request->has('content')) {
            return response()->json('Post content is required', 400);
        }
        if (!$request->has('filepath')) {
            return response()->json('post image is required', 400);
        }
        if (trim($request->input('title')) === '') {
            return response()->json('title is empty', 400);
        }
        if (trim($request->input('content')) === '' ) {
            return response()->json('content is empty', 400 );
        }
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->input('title');
        $post->slug  = str_slug( $request->input('title'), '-');
        $post->content = $request->input('content');
        $post->category_id = (int)$request->input('category');
        $post->status = $request->input('status');
        $post->meta_description = $request->input('meta_description');
        $post->thumbnail = $request->input('filepath');
        $post->tags = $request->input('tags');
        $post->save();
        return $post->id;
    }
    public function editPost( Request $request ) {
        if ( !$request->has('id') ) {
            return response()->json('post id is missing', 400 );
        }
        $post = Post::find( $request->input('id') );
        if( !$post ) {
            return response()->json( 'post does not found', 400);
        }
        return response()->json( $post, 200 );
    }
    public function deletePost( Request $request ) {
        if( !$request->has('id') ) {
            return response()->json('Post id not found', 400);
        }
        $post = Post::find($request->input('id'));
        if ( $post ) {
            $post->delete();
            return response()->json('post is deleted successfully', 200);
        }
        return response()->json('post not found', 400);
    }

}