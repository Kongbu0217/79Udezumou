<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //MIO
    function __construct()
    {
        $this->post = new Post();
    }

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

        // $posts = $query->get(); // 条件に応じてデータを取得
        $posts = $query->orderBy('created_at', 'desc')->get();

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


        // バリデーション
        $request->validate([
        'title' => 'required|max:30', // タイトルは必須で30文字以内
        'body' => 'required|max:140', // 内容は必須で140文字以内
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'prio' => 'required|not_in:zero', // 優先順位: 必須で "zero" (--) を選ばせない
    ], [
        'title.required' => 'タイトルは入力必須項目です。',
        'title.max' => 'タイトルは30文字以内で入力してください。',
        'body.required' => '内容は入力必須項目です。',
        'body.max' => '内容は140文字以内で入力してください。',
        'prio.required' => '優先順位を選択してください。',
        'prio.not_in' => '優先順位を選択してください。',
    ]);

        // $requestに入っている値を、new Postでデータベースに保存するという記述
        $post = new Post;

        // 画像がアップロードされていれば保存処理(MIO)
            if ($request->hasFile('image')) {
            // ファイルをpublicディスクに保存してパスを取得
            $path = $request->file('image')->store('images', 'public');
            
            // 画像パスをデータベースに保存
            $post->path = $path;
            }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id(); // 現在ログインしているユーザーidを取得

        $post->prio = $request->prio; //優先順位
        $post->moto = $request->moto; //モチベーション
        $post->category = $request->category; //カテゴリー
        $post->cob = $request->cob; //締切日
        //（MIO)

        $post->save();

        return redirect()->route('posts.index')->with('status', '投稿が作成されました！');
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
        
        $request->validate([
            'title' => 'required|max:30', // タイトルは必須で30文字以内
            'body' => 'required|max:140', // 内容は必須で140文字以内
            'prio' => 'required|not_in:zero', // 優先順位: 必須で "zero" (--) を選ばせない
        ], [
            'title.required' => 'タイトルは入力必須項目です。',
            'title.max' => 'タイトルは30文字以内で入力してください。',
            'body.required' => '内容は入力必須項目です。',
            'body.max' => '内容は140文字以内で入力してください。',
            'prio.required' => '優先順位を選択してください。',
            'prio.not_in' => '優先順位を選択してください。',
        ]);
        
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->prio = $request->input('prio');
        $post->category = $request->input('category');
        $post->moto = $request->input('moto');
        $post->cob = $request->input('cob');
        $post->save();

        return redirect()->route('posts.index')->with('status', '投稿が更新されました！');
    }    

    function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
