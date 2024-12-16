<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post()  // post()の部分がbelongsToの場合は単数形にhasManyは複数形
    {
        return $this->belongsTo('App\Models\Post'); // 一つのコメントは、一つの投稿に紐づくのでbelongsToを使う
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
