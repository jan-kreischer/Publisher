<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ratings', function(Blueprint $table) {
			$table->increments('rating_id')->comment('PK for ratings table');
				
			$table->integer('user_id')->unsigned()->references('user_id')
			->on('users')->comment('FK to user_id on users table');
				
			$table->integer('article_id')->unsigned()->references('article_id')
			->on('articles')->comment('FK to article_id on articles table');
			
			$table->enum('rating_value', [1, -1, 0])->comment('1 for top, 0 for neutral, -1 for down');
			//timestamp for simple rating not necessary
			//$table->timestamps();
			
			$table->unique(array('user_id', 'article_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ratings');
	}

}
