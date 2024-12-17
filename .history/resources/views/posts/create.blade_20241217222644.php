@extends('layouts.app_original')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf <!-- これないとエラーになる -->
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" class="form-control" placeholder="タイトルを入力して下さい" name="title">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea class="form-control" placeholder="内容" rows="5" name="body">
                    </textarea>
                </div>
                
{{-- MIO --}}
                <div>
                    <label>優先順位</label><br>
                    <select name="prio">
                        <option value="first">1その他</option>
                        <option value="second">2その他</option>
                        <option value="third">3その他</option>
                    </select>
                </div>
                <div>
                    <label>モチベーション</label><br>
                    <select name="moto">
                        <option value="first">高</option>
                        <option value="second">中</option>
                        <option value="third">低</option>
                    </select>
                </div>
                <div>
                    <label>カテゴリー</label><br>
                    <select name="category">
                        <option value="first">カテゴリー１</option>
                        <option value="second">カテゴリー２</option>
                        <option value="third">カテゴリー３</option>
                    </select>
                </div>
                <div>
                    <label>締切日</label><br>
                    <input type="date" name="cob">
                </div>
{{-- MIO --}}

                <button type="submit" class="btn btn-primary">作成</button>
            </form>
        </div>
    </div>
</div>

@endsection