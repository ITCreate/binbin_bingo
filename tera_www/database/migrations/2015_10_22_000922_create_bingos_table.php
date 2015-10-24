<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBingosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bingos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('card_id')->nullable();
			$table->integer('number');
			$table->tinyInteger('x');
			$table->tinyInteger('y');
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
		Schema::drop('bingos');
	}

}
