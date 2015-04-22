<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model {
	public function kind(){
		return $this->belongsTo('App\Kind');
	}
}
