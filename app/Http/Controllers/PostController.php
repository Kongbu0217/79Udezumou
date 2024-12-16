<?php

namespace App\Http\Controllers;
use App\Models\Post;

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
}
