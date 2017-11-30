<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
	use SoftDeletes;
	protected $dates =['deleted_at'];
	   protected $fillable = [
	   'title',
	   'body',
	   'category_id',
	   'photo_id',
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
}
