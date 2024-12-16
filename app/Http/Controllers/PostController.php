<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    function index()
    {
        $posts = Post::all(); // Post.phpを呼び出し、変数postsに格納する
        // dd($posts);
        return view('posts.index', ['posts' => $posts]);
    }

    function create()
    {
        return view('posts.create');
    }

    function store(Request $request)
    {
        $post = new Post;
        $post -> title = $request -> title;
        $post -> body = $request -> body;
        $post -> user_id = Auth::id();

        $post -> save();

        return redirect()->route('posts.index');
    }
}
