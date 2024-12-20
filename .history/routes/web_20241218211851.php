<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/create', function () {
//     return view('posts.create');
// });

//画像アップロードのルート
Route::resource('posts', PostController::class);

Route::get('/posts', [PostController::class,'index'])->name('posts.index');

Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');

Route::post('/posts', [PostController::class,'store'])->name('posts.store');

Route::get('/posts/{id}', [PostController::class,'show'])->name('posts.show');

Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');

Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/comments/create/{post_id}',[CommentController::class,'create'])->name('comments.create');

Route::post('/comments',[CommentController::class,'store'])->name('comments.store');

// ===コメント用===
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit'); // コメント編集ページ

Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');  // コメント更新

Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy'); // コメント削除
