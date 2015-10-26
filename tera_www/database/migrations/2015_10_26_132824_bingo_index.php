<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BingoIndex extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bingos', function($table){
			$table->unique(['card_id', 'x', 'y']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bingos', function($table){
			$table->dropUnique(['card_id', 'x', 'y']);
		});
	}

}
