<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\User;
use App\Pet;
use App\Recode;
use App\Kind;
use App\Type;
Route::get('test', function(){
	// $user = new User;
	// $user->name = 'test1';
	// $user->username = 'test1';
	// $user->email = 'test1@email';
	// $user->save();

	// $Type = new Type;
	// $Type->name = '黃金';
	// $Type->kind_id = 1;
	// $Type->save();

	$pet = Pet::find(1);
	// echo '================<pre>';
	// var_dump($pet->users);
	// echo '</pre>================';
	echo '================<pre>';
	$kind = $pet->kind;
	var_dump($pet->kind->name);
	echo '</pre>================';
	echo '================<pre>';
	$type = $pet->type;
	var_dump($type->name);
	var_dump($pet->type->name);
	echo '</pre>================';
	exit;
});


Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');

Route::pattern('id', '[0-9]+');
Route::get('news/{id}', 'ArticlesController@show');
Route::get('video/{id}', 'VideoController@show');
Route::get('photo/{id}', 'PhotoController@show');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::controllers(['pet' => 'PetController']);

if (Request::is('admin/*'))
{
    require __DIR__.'/admin_routes.php';
}
