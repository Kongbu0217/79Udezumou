@extends('layouts.app_original')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h2>コメントを編集</h2>
            <div class="card mt-3">
                <div class="card-body">
                    <form action="{{ route('comments.update', $comment->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>コメント内容</label>
                            <textarea class="form-control" rows="5" name="body">{{ $comment->body }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mt-3">更新する</button>
                        <a href="{{ route('posts.show', $comment->post_id) }}" class="btn btn-sm btn-secondary mt-3">戻る</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
