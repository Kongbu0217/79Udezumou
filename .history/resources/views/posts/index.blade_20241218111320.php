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
                        <h5 class="card-title"> {{ $post->title }}</h5>
                        <div class="image-container mb-3">
                          <img src="{{ $post->image_path }}" class="img-fluid" alt="投稿画像">
                        </div>
                        <p class="card-text"> {{ $post->body }}</p>
                        <p class="card-text small">投稿者：{{ $post->user->name }}</p>
                    </div>
                    <div class="card-footer text-center">
                      <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm" target="_blank">
                        詳細
                          @if($post->comments->count() > 0)
                            <span>(コメント{{ $post->comments->count() }}件)</span>
                            @endif
    </a>
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