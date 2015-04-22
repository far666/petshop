<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pet_id');	//foreign key from pet
			$table->integer('status');
			$table->string('service',60);	//wash, cut ..etc
			$table->integer('price');
			$table->integer('payment');	//how to pay ,now should be only cash
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recodes');
	}

}
