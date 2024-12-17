<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index(Request $request)
    {
        $query = Post::query();

        // 検索クエリを取得
        $search = $request->input('search');

        if ($search) {
            // タイトル、本文、コメント内容を検索対象に追加
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('body', 'LIKE', "%{$search}%")
                    ->orWhereHas('comments', function ($subQuery) use ($search) {
                    $subQuery->where('body', 'LIKE', "%{$search}%");
                        });
            });
        }

        $posts = $query->get(); // 条件に応じてデータを取得

        return view('posts.index', [
            'posts' => $posts,
            'search' => $search, // 現在の検索ワードをビューに渡す
        ]);
    }

    function create()
    {
        return view('posts.create');
    }

    function store(Request $request)
    {
        // $requestに入っている値を、new Postでデータベースに保存するという記述
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id(); // 現在ログインしているユーザーidを取得

        $post->save();

        return redirect()->route('posts.index');
    }

    function show($id)
    {
        // 投稿データとそのコメントを取得
        $post = Post::with('comments.user')->find($id);

        if (!$post) {
            abort(404, '投稿が見つかりませんでした。');
        }

        return view('posts.show', ['post' => $post]);
    }

    function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', ['post' => $post]);
    }

    function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return view('posts.show', ['post' => $post]);
    }

    function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();
        
        return redirect()->route('posts.index');
    }
}
