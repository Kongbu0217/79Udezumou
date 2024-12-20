@extends('layouts.app_original')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf <!-- これないとエラーになる -->
    <div class="form-group">
        <label>タイトル</label>
        <input type="text" class="form-control" placeholder="タイトルを入力して下さい" name="title" required>
    </div>
    <div class="form-group">
        <label>内容</label>
        <textarea class="form-control" placeholder="内容" rows="5" name="body" required></textarea>
    </div>
    <div>
        <label>優先順位</label><br>
        <select name="prio" required>
            <option value="1">1: 高</option>
            <option value="2">2: 中</option>
            <option value="3">3: 低</option>
        </select>
    </div>
    <div>
        <label>モチベーション</label><br>
        <select name="moto">
            <option value="high">高</option>
            <option value="medium">中</option>
            <option value="low">低</option>
        </select>
    </div>
    <div>
        <label>カテゴリー</label><br>
        <select name="category">
            <option value="category1">カテゴリー1</option>
            <option value="category2">カテゴリー2</option>
            <option value="category3">カテゴリー3</option>
        </select>
    </div>
    <div>
        <label>締切日</label><br>
        <input type="date" name="cob">
    </div>
    <div>
        <label for="image">画像を選択</label><br>
        <input type="file" name="image" id="image" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">作成</button>
</form>
        </div>
    </div>
</div>

@endsection