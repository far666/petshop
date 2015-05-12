<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;
class Recode extends Model {

	// protected $pet;
	// protected $auth;
	static public $status = [
				0 =>'預約中',
				1 =>'預約成功',
				2 =>'處理中',
				3 =>'完成',
				4 =>'已領走',
				5 =>'取消',
				6 =>'逾時系統取消',
				7 =>'預約已滿',
			];
	static public $services =[
				0=>'cut',
				1=>'wash',
				2=>'cut and wash',
			];

	static public $payment_method = [
				0=>'cash',
				1=>'cash 23',
			];

	static public $max_reserve_count = 3;

	public function pet(){
		return $this->belongsTo('App\Pet');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}

	/**
	*	update recode status, (not necessary
	*
	*@return boolean
	*/
	public function update_status($status) {
		$this->status = $status;
		$this->save();
	}
}
