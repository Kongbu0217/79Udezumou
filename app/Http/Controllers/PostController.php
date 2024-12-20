<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function index(Request $request)
    {
        $query = Post::query();

        // 検索クエリの処理
        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('body', 'LIKE', "%{$search}%")
                    ->orWhereHas('comments', function ($subQuery) use ($search) {
                        $subQuery->where('body', 'LIKE', "%{$search}%");
                    });
            });
        }

        // ソートの処理
        $sort = $request->input('sort', 'created_at_asc'); // デフォルトは日時順
        switch ($sort) {
            case 'cob_asc':
                $query->orderBy('cob', 'asc');
                break;
            case 'cob_desc':
                $query->orderBy('cob', 'desc');
                break;
            case 'created_at_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'created_at_desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'prio_asc':
                $query->orderByRaw("FIELD(prio, 'first', 'second', 'third')");
                break;
            case 'prio_desc':
                $query->orderByRaw("FIELD(prio, 'third', 'second', 'first')");
                break;
            default:
                $query->orderBy('created_at', 'asc');
                break;
        }

        $posts = $query->get();

        return view('posts.index', [
            'posts' => $posts,
            'search' => $search,
            'sort' => $sort,
        ]);
    }

    function create()
    {
        return view('posts.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'body' => 'required|max:140',
            'prio' => 'required|not_in:zero',
        ], [
            'title.required' => 'タイトルは必須項目です。',
            'title.max' => 'タイトルは30文字以内で入力してください。',
            'body.required' => '内容は必須項目です。',
            'body.max' => '内容は140文字以内で入力してください。',
            'prio.required' => '優先順位を選択してください。',
            'prio.not_in' => '優先順位を選択してください。',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id();
        $post->prio = $request->prio;
        $post->moto = $request->moto;
        $post->category = $request->category;
        $post->cob = $request->cob;
        $post->save();

        return redirect()->route('posts.index')->with('status', '投稿が作成されました！');
    }

    function show($id)
    {
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
            'title' => 'required|max:30',
            'body' => 'required|max:140',
            'prio' => 'required|not_in:zero',
        ], [
            'title.required' => 'タイトルは必須項目です。',
            'title.max' => 'タイトルは30文字以内で入力してください。',
            'body.required' => '内容は必須項目です。',
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
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
