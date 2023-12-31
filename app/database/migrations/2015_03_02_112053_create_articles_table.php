<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('article_id');
			$table->string('article_str')->unique();
			$table->integer('user_id')->unsigned()->references('user_id')->on('users');
			$table->string('article_title');
			$table->text('article_content');
			$table->string('article_summary')->nullable();
			$table->string('article_info')->nullable();
			$table->enum('article_visibility', ['public', 'protected', 'private'])->default('public');
			$table->boolean('article_published')->default(0)->comment('0 => not published, 1 => published');
			$table->integer('category_id')->unsigned()->references('category_id')->on('categories')->default('1');
			$table->integer('article_view_count')->unsigned()->default('0');
			//$table->integer('comment_count')->unsigned()->default('0');
			//$table->integer('up_count')->unsigned()->default('0');
			//$table->integer('down_count')->unsigned()->default('0');
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
		Schema::drop('articles');
	}

}
