<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // === コメント作成ページを表示 ===
    public function create($post_id)
    {
        $post = Post::find($post_id);
        return view('comments.create', ['post'=>$post]);
    }

    // === コメントを保存 ===
    public function store(Request $request)
    {
        $post = Post::find($request->post_id);
        $comment = new Comment;
        $comment -> body = $request -> body;
        $comment -> user_id = Auth::id();
        $comment -> post_id = $request ->post_id;
        $comment -> save();

        // return view('posts.show', ['post'=>$post]);
        return redirect()->route('posts.show', $post->id);
    }
    // === コメント編集ページを表示 ===
    public function edit($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            abort(404, 'コメントが見つかりませんでした。');
        }

        return view('comments.edit', ['comment' => $comment]);
    }

    // === コメントを更新 ===
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            abort(404, 'コメントが見つかりませんでした。');
        }

        $comment->body = $request->body;
        $comment->save();

        return redirect()->route('posts.show', $comment->post_id);
    }

    // === コメントを削除 ===
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            abort(404, 'コメントが見つかりませんでした。');
        }

        $comment->delete();

        return redirect()->route('posts.show', $comment->post_id);
    }
}
