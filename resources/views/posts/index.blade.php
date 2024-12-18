@extends('layouts.app_original')
@section('content')

<div class="container mt-5">
<!-- 検索フォーム -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6"> <!-- 検索窓の幅を中央寄せ＆調整 -->
            <form action="{{ route('posts.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="タイトルや本文を検索" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">検索</button>
                </div>
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
                        <h5 class="card-title"> {{ $post->title }}</h5> <!-- 見出し -->
                        <div class="image-container mb-3">
                            <img src="{{ $post->image_path }}" class="img-fluid" alt="投稿画像">  <!-- 画像 -->
                        </div>
                        <!-- 優先順位、カテゴリーを横並びで表示 -->
                        <div class="d-flex justify-content-around mb-3">
                            <span>優先順位: {{ $post->prio }}</span> <!-- 優先順位 -->
                            <span>カテゴリー: {{ $post->category }}</span> <!-- カテゴリー -->
                        </div>
                        <p class="card-text"> {{ $post->body }}</p> <!-- 本文 -->
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