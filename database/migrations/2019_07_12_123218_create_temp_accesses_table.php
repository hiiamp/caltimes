<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTempAccessesTable.
 */
class CreateTempAccessesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::defaultStringLength(191);
		Schema::create('temp_accesses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->bigInteger('todo_list_id')->unsigned();
            $table->foreign('todo_list_id')->references('id')->on('todo_list');
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
		Schema::drop('temp_accesses');
	}
}
