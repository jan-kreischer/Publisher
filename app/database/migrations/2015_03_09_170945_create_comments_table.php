<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
			$table->increments('comment_id');
			
			$table->integer('user_id')->unsigned()->references('user_id')
			->on('users')->comment('FK to user_id on users table');
			
			$table->integer('article_id')->unsigned()->references('article_id')
			->on('articles')->comment('FK to article_id on articles table');
			
			$table->string('comment_content');
			$table->boolean('approved')->default('1');
			
			$table->softDeletes();
			$table->timestamps();
			$table->integer('language_id')->unsigned()->default('1')->references('language_id')->on('languages');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
