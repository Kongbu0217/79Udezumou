@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3>{{ __('ログインに成功しました') }}</h3>
                </div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="mb-4">
                        {{ __('Hello, :name! You are now logged in!', ['name' => Auth::user()->name]) }}
                    </p>

                    <a href="{{ route('posts.index') }}" class="btn btn-primary">
                        {{ __('To-Do リストを見る') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
