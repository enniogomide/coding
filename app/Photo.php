<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
	protected $fotos = '/images/';
	protected $fillable = ['file'];
	// recuperar fotos
	public function getFileAttribute($photo){
		return $this->fotos . $photo;
	}
	public function user(){
		return $this->belongsTo('App\User');

	}
}
