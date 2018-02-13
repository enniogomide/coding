<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    use Sluggable;
    use SluggableScopeHelpers;
	use SoftDeletes;
	protected $dates =['deleted_at'];
    protected $fillable = [
    'title',
    'body',
    'category_id',
    'photo_id',
    'slug',
    ];
   public function user(){
       return $this->belongsTo('App\User');
   }
   public function photo(){
       return $this->belongsTo('App\Photo');
   }
   public function category(){
       return $this->belongsTo('App\Category');
   }
   public function comments(){
    return $this->hasMany('App\Comment');
   }
   public function commentsreplies(){
    return $this->hasManyThrough('App\CommentReply', 'App\Comment');
   }
   public function photoPlaceHolder(){
       return "/images/no-foto.jpg";
   }                 
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
