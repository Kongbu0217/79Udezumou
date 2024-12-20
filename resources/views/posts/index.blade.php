@extends('layouts.app_original')
@section('content')

<div class="container mt-5">
    <!-- 検索フォームとソート機能 -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form action="{{ route('posts.index') }}" method="GET" class="d-flex align-items-center">
                <!-- 検索フォーム -->
                <input type="text" name="search" class="form-control me-2" placeholder="タイトルや本文を検索" value="{{ request('search') }}" style="flex: 2;">

                <!-- ソートセレクト -->
                <select name="sort" class="form-select me-2" style="flex: 1;">
                    <option value="cob_asc" {{ request('sort') === 'cob_asc' ? 'selected' : '' }}>締切日（早→遅）</option>
                    <option value="cob_desc" {{ request('sort') === 'cob_desc' ? 'selected' : '' }}>締切日（遅→早）</option>
                    <option value="created_at_asc" {{ request('sort') === 'created_at_asc' ? 'selected' : '' }}>登録日（登録）</option>
                    <option value="created_at_desc" {{ request('sort') === 'created_at_desc' ? 'selected' : '' }}>登録日（新着順）</option>
                    <option value="prio_asc" {{ request('sort') === 'prio_asc' ? 'selected' : '' }}>優先度（高→低）</option>
                    <option value="prio_desc" {{ request('sort') === 'prio_desc' ? 'selected' : '' }}>優先度（低→高）</option>
                </select>

                <!-- 検索ボタン -->
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 text-end mb-3">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                新規投稿
            </a>
        </div>
    </div>

    <!-- 投稿リスト -->
    <div class="row">
        @if($posts->count() > 0)
            @foreach($posts as $post)
            <div class="col-md-3 mb-4"> <!-- カードを横4つに -->
                <div class="card h-100"> <!-- 高さ統一 -->
                    <div class="card-body text-center">
                        <h5 class="card-title"> {{ $post->title }}</h5> <!-- タイトル -->
                        <div class="image-container mb-3">
                            <img src="{{ $post->image_path }}" class="img-fluid" alt="投稿画像">  <!-- 画像 -->
                        </div>
                        <!-- 優先順位、カテゴリーを横並びで表示 -->
                        <div class="d-flex justify-content-around mb-3">
                            <span>優先順位: {{ $post->prio }}</span> <!-- 優先順位 -->
                            <span>カテゴリー: {{ $post->category }}</span> <!-- カテゴリー -->
                        </div>
                        <p class="card-text"> {{ $post->body }}</p> <!-- 内容 -->
                        <!-- モチベーション、締め切り日を横並びで表示 -->
                        <div class="d-flex justify-content-around mb-3">
                        <span>モチベーション: {{ $post->moto }}</span> <!-- モチベーション -->
                        <span>締切日: {{ $post->cob }}</span> <!-- 締め切り日 -->
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm" target="_blank">
                        詳細
                        @if($post->comments->count() > 0)
                        <span>(コメント{{ $post->comments->count() }}件)</span>
                        @endif
                        </a>
                        <p>投稿者：{{ $post->user->name }}</p> <!-- 投稿者 -->
                    </div>
            </div>
    </div>
        @endforeach
        @else
    <!-- 検索結果がない場合表示 -->
            <div class="col-12 text-center">
                <p>検索結果が見つかりませんでした。</p>
            </div>
        @endif
    </div>
</div>

@endsection
