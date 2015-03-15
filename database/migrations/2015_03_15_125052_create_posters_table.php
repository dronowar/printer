<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order_id')->unsigned()->index();
			$table->foreign('order_id')->references('id')->on('orders');
			$table->mediumText('maket_url');
			$table->tinyInteger('maket_status')->unsigned();
			$table->integer('paper_id')->unsigned()->index();
			$table->float('w');
			$table->float('h');
			$table->integer('quantity')->unsigned();
			$table->float('poster_price');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posters');
	}

}
