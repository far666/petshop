<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pet;
use App\User;
use App\Recode;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Support\Facades\Session;
class RecodeController extends Controller {

	

	public function getIndex(Guard $auth)
	{
		$user = $auth->user();
		$status = Recode::$status;
		$services = Recode::$services;
		$payment_method = Recode::$payment_method;
		return view('recode.index',compact('user','status','services','payment_method'));
	}

	public function getCreate(Guard $auth)
	{
		$pets = $auth->user()->pets;
		$services = Recode::$services;
		$payment_method = Recode::$payment_method;
		return view('recode.create',compact('pets','services','payment_method'));
	}

	public function postCreate(Request $request,Guard $auth)
	{
		/**
		 *	add recode
		 */

		$recode = new Recode;
		$recode->user_id	= $auth->user()->id;
		$recode->pet_id 	= $request->input('pet_id');
		$recode->service 	= $request->input('service');
		$recode->payment 	= $request->input('payment');	
		$recode->service_date 	= date("Y-m-d",strtotime($request->input('service_date')));
		$recode->status 	= array_search('預約中',Recode::$status);
		
		/**
		*	check the selected pet dont have other alive reserve today
		*/
		$pet = Pet::find($recode->pet_id);	
		if($pet->reserved($recode->service_date))
			return redirect($this->redirectPath())->with("error","$pet->name already has a reservetion on $recode->service_date. ");

		$recode->save();	
		return redirect($this->redirectPath());
	}

	
	/*
	*  use to cancel a recode
	*/
	public function anyCancel($recode_id,Guard $auth)
	{
		$recode  = Recode::find($recode_id);
		if($recode->user_id != $auth->user()->id || !in_array($recode->status, array(array_search('預約中',Recode::$status), array_search('預約成功',Recode::$status)))) 
			return redirect('recode')->with('error', 'You can not cancel this ! ');
		
		/*
			change status to cancel
		*/
		$recode->status = array_search("取消", Recode::$status);
		$recode->save();

		return redirect('recode')->with('success', 'Your Reserve is Canceled! ');
	}

	/*
	* won't use this
	*/
	public function getShow($id,Guard $auth)
	{
		$pet = Pet::find($id);
		$admin = $pet->admin($auth->user()->id);

		return view('pet.show',compact('pet','admin'));
	}

	public function getEdit($recode_id,Guard $auth)
	{
		$recode = Recode::find($recode_id);
		if(empty($recode))
			return redirect('recode')->with('error', 'No Such Recode !');

		if($recode->user_id != $auth->user()->id || !in_array($recode->status,array(array_search('預約中',Recode::$status),array_search('預約成功',Recode::$status))))
			return redirect('recode')->with('error', 'You can not edit this recode! ');

		$services = Recode::$services;
		$payment_method = Recode::$payment_method;
		return view('recode.edit',compact('recode','services','payment_method'));
	}


	public function postEdit($recode_id,Request $request,Guard $auth)
	{
		if($recode->user_id != $auth->user()->id) 
			return redirect('recode')->with('error', 'You can not edit this recode! ');
		
		$recode = Recode::find($recode_id);
		$recode->service 	= $request->input('service');
		$recode->payment 	= $request->input('payment');	
		$recode->service_date 	= date("Y-m-d",strtotime($request->input('service_date')));

		return redirect($this->redirectPath());
	}

	public function getAdmin(Guard $auth)
	{
		
		if($auth->user()->admin != 1)
			return redirect($this->redirectPath());	
		$date = "2015-04-28";

		$recodes = Recode::where("service_date","=",$date)->take(1);

		foreach ($recodes as $recode) {
			echo $recode->id."<br>";
		}

		$status = Recode::$status;
		$services = Recode::$services;
		$payment_method = Recode::$payment_method;
		

		return view('recode.admin',compact('recodes','status','services','payment_method'));
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/recode';
	}
}
