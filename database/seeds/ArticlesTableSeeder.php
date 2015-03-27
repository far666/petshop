<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ArticlesTableSeeder extends Seeder
{

	public function run()
	{
		TestDummy::times(4)->create('App\Article');
	}

}