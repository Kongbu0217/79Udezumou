<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    // MIO
    // モデルに関連付けるテーブル
    protected $table = 'posts';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    // 登録・更新可能なカラムの指定
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'created_at',
        'updated_at',
        'prio',
        'moto',
        'category',
        'cob',
        'path',
    ];
    /**
     * 一覧画面表示用にbooksテーブルから全てのデータを取得
     */
    public function findAllPosts()
    {
        return Post::all();
    }

    /**
     * リクエストされたIDをもとにbooksテーブルのレコードを1件取得
     */
    public function findPostById($id)
    {
        return Post::find($id);
    }

    //MIO

    public function comments() // 複数コメントが投稿されることを想定し、commentは複数形のcommentsとなる。hasManyを使う

    {
            return $this->hasMany('App\Models\Comment');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /*MIO
     * 削除処理
     */
    function deletePostById($id)
    {
        return $this->destroy($id);
    }
}
