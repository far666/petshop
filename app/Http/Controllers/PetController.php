<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pet;
use App\User;
use App\Kind;
use App\Type;
use App\Recode;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class PetController extends Controller {

	protected $pet;
	protected $auth;

	public function getIndex(Guard $auth)
	{
		$user = $auth->user();
		$mypets = $user->pets;
		

		return view('pet.index',compact('mypets'));
	}

	public function getCreate()
	{
		//kind
		$kinds = Kind::all();
		$types = Type::all();
		return view('pet.create',compact('kinds','types'));
	}

	public function postCreate(Request $request,Guard $auth)
	{
		/**
		 *	1.add pet 	
		 *	2.add the relationship user_pet	
		 */
		
		$this->pet = new Pet;
		$this->pet->name 	= $request->input('petname');
		$this->pet->kind_id 	= $request->input('kind_id');
		$this->pet->type_id 	= $request->input('type_id');
		$this->pet->sex 	= $request->input('sex');
		$this->pet->born 	= date("Y-m-d",strtotime($request->input('born')));
		$this->pet->tall 	= $request->input('tall');
		$this->pet->weight 	= $request->input('weight');
		$this->pet->save();

		$this->auth = $auth;
		$this->pet->users()->attach($this->auth->user()->id,['admin' => 1]);
		return redirect($this->redirectPath());
	}

	public function getShow(Guard $auth,$id)
	{
		$pet = Pet::find($id);
		$admin = $pet->admin($auth->user()->id);

		$status = Recode::$status;
		$services = Recode::$services;
		$payment_method = Recode::$payment_method;
		return view('pet.show',compact('pet','admin','status','services','payment_method'));
	}

	public function getAdduser($id,Guard $auth)
	{
		$pet = Pet::find($id);
		
		$admin = $pet->admin($auth->user()->id);
		if($admin){
			$users = User::all();
			foreach ($users as $index => $user) {
				foreach ($pet->users as $selected_user) {
					if($user->id == $selected_user->id){
						unset($users[$index]);
						break;
					}
				}
			}
		}else {
			$user = array();
		}

		return view('pet.adduser',compact('pet','users','admin'));
	}


	public function postAdduser(Request $request,$id)
	{
		$this->pet = Pet::find($id);
		$this->pet->users()->attach($request->input('user_id'));
		return redirect($this->redirectPath());
	}

	public function getDeluser($id,Guard $auth)
	{
		$pet = Pet::find($id);
		
		$admin = $pet->admin($auth->user()->id);
		
		$users = array();
		foreach ($pet->users as $user) {
			if($user->id != $auth->user()->id) {
				$users[]  = $user;
			}
		}
		
		return view('pet.deluser',compact('pet','users','admin'));
	}


	public function postDeluser(Request $request,$id)
	{
		$this->pet = Pet::find($id);
		$this->pet->users()->detach($request->input('user_id'));
		return redirect($this->redirectPath());
	}

	public function getEdit()
	{
		// $users = User::all();
		// return view('pet.edituser',compact('users'));
	}


	public function postEdit()
	{
		// $this->pet->users()->attach($this->auth->user()->id);
		// return redirect($this->redirectPath());
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

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/pet';
	}
}
