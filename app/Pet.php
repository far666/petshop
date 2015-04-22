<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model {
	
	public function users() {
		return $this->belongsToMany('App\User');
	}

	public function kind() {
		return $this->belongsTo('App\Kind');
	}

	public function type() {
		return $this->belongsTo('App\Type');
	}

}
