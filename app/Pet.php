<?php namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model {
	
	public function users() {
		return $this->belongsToMany('App\User')->withPivot('admin');
	}

	public function kind() {
		return $this->belongsTo('App\Kind');
	}

	public function type() {
		return $this->belongsTo('App\Type');
	}

	public function recodes() {
		return $this->hasMany('App\Recode');
	}

	public function admin($user_id) {
		$result = DB::select('select admin from pet_user where `pet_id` = ? and `user_id` = ? ', [$this->id,$user_id]);
		return $result[0]->admin;
	}


	/**
	 * To check this dont have other reservation 
	 *
	 * @var boolean
	 */
	public function reserved($date) {
		echo $date;
		$status = 5;
		$result = DB::select("select * from recodes where `pet_id` = ? AND `service_date` = ? AND `status` != ?", [$this->id,$date,$status]);
		
		if($result)
			return true;
		else
			return false;
	}
}
