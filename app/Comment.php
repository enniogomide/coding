<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Comment extends Model
{
    //
    protected $fillable = [
        'post_id',
        'is_active',
        'author',
        'email',
        'photo',
        'body',
        ];

    public function post(){
        return $this->belongsTo('App\Post');
    }
    public function replies(){
        return $this->hasMany('App\CommentReply');
    }                   
}
