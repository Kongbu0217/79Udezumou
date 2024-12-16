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
        // dd($posts);
        // $requestに入っている値を、new Postでデータベースに保存するという記述
        $post = new Post;
        // 左辺：テーブル、右辺が送られてきた値(formから送られてきたnameが入っている)
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id(); // 現在ログインしているユーザーidを取得。上にはuse Illuminate\Support\Facades\Auth;の記述必要

        $post->save();

        return redirect()->route('posts.index');

    }
        // $idはindex.blade.phpから送られてきたid
    function show($id)
    {
        // dd($id);
        $post = Post::find($id);

        return view('posts.show', ['post' => $post]);
    }

    function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', ['post'=> $post]);
    }

    function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post -> title = $request -> title;
        $post -> body = $request -> body;
        $post -> save();

        return view('posts.show',['post'=>$post]);
    }

    function destroy($id)
    {
        $post = Post::find($id);

        $post -> delete();
        
        return redirect()->route('posts.index');
    }

}
