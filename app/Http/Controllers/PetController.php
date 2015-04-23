<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pet;
use App\User;
use App\Kind;
use App\Type;

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
		$this->pet->users()->attach($this->auth->user()->id);
		return redirect($this->redirectPath());
	}

	public function getShow($id)
	{
		$pet = Pet::find($id);
		return view('pet.show',compact('pet'));
	}

	public function getEdituser($id)
	{
		$pet = Pet::find($id);
		$users = User::all();

		$selected = array();
		foreach ($pet->users as $user) {
			$selected[] = $user->id;
		}
		var_dump($selected);
		return view('pet.edituser',compact('pet','users','selected'));
	}


	public function postEdituser(Request $request,$id)
	{
		$this->pet = Pet::find($id);
		$selected = $request->input('user_id');
		$this->pet->users()->detach();
		$this->pet->users()->attach($selected);
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
