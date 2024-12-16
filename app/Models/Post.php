<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function comments() // 複数コメントが投稿されることを想定し、commentは複数形のcommentsとなる。hasManyを使う

    {
            return $this->hasMany('App\Models\Comment');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
