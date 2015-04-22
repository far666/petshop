<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('kind_id');		//1=dog,2=cat
			$table->integer('type_id');		//1=mixd,2=maltese..others
			$table->string('sex');		
			$table->integer('age');
			$table->integer('tall');
			$table->integer('weight');
			$table->timestamps();
		});

		//many to many rel
		Schema::create('pet_user', function(Blueprint $table)
		{
			$table->integer('user_id');
			$table->integer('pet_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('pets');
		Schema::dropIfExists('pet_user');
	}

}
