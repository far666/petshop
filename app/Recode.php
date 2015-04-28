<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Recode extends Model {


	public function pet(){
		return $this->belongsTo('App\Pet');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}
}
