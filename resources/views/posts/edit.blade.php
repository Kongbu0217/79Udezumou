@extends('layouts.app_original')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('put')

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- タイトル -->
                <div class="form-group mb-3">
                    <label>タイトル</label>
                    <input type="text" class="form-control" value="{{ $post->title }}" name="title">
                </div>

                <!-- 内容 -->
                <div class="form-group mb-3">
                    <label>内容</label>
                    <textarea class="form-control" rows="5" name="body">{{ $post->body }}</textarea>
                </div>

                <!-- 優先順位 -->
                <div class="form-group mb-3">
                    <label>優先順位</label><br>
                    <select name="prio">
                        <option value="zero" {{ $post->prio == 'zero' ? 'selected' : '' }}>--</option>
                        <option value="first" {{ $post->prio == 'first' ? 'selected' : '' }}>高</option>
                        <option value="second" {{ $post->prio == 'second' ? 'selected' : '' }}>中</option>
                        <option value="third" {{ $post->prio == 'third' ? 'selected' : '' }}>低</option>
                    </select>
                </div>

                <!-- モチベーション -->
                <div class="form-group mb-3">
                    <label>モチベーション</label><br>
                    <select name="moto">
                        <option value="zero" {{ $post->moto == 'zero' ? 'selected' : '' }}>--</option>
                        <option value="first" {{ $post->moto == 'first' ? 'selected' : '' }}>高</option>
                        <option value="second" {{ $post->moto == 'second' ? 'selected' : '' }}>中</option>
                        <option value="third" {{ $post->moto == 'third' ? 'selected' : '' }}>低</option>
                    </select>
                </div>

                <!-- カテゴリー -->
                <div class="form-group mb-3">
                    <label>カテゴリー</label><br>
                    <select name="category">
                        <option value="zero" {{ $post->category == 'zero' ? 'selected' : '' }}>--</option>
                        <option value="first" {{ $post->category == 'first' ? 'selected' : '' }}>単語</option>
                        <option value="second" {{ $post->category == 'second' ? 'selected' : '' }}>文法</option>
                        <option value="third" {{ $post->category == 'third' ? 'selected' : '' }}>スピーキング</option>
                    </select>
                </div>

                <!-- 締切日 -->
                <div class="form-group mb-3">
                    <label>締切日</label><br>
                    <input type="date" class="form-control" name="cob" value="{{ $post->cob }}">
                </div>

                <button type="submit" class="btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</div>

@endsection
