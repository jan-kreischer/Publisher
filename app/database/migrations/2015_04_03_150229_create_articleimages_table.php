<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleimagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articleimages', function(Blueprint $table) {
			$table->increments('articleimage_id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('user_id')->on('users')->comment('FK to users table');
			$table->integer('article_id')->unsigned()->nullable();
			$table->foreign('article_id')->references('article_id')->on('articles')->comment('FK to articles table');
			$table->string('articleimage_name')->comment('filename without extension. required');
			$table->string('articleimage_extension')->comment('file extension. required');
			$table->integer('articleimage_size')->comment('size of the file in bytes. required');
			$table->integer('articleimage_width')->comment('width of the file. required');
			$table->integer('articleimage_height')->comment('height of the file. required');
			$table->string('articleimage_title')->nullable()->comment('title of the file. optional');
			$table->string('articleimage_description')->nullable()->comment('description of the file. optional');
			$table->integer('articleimage_offset_top')->nullable()->comment('offset from top border if cropped');
			$table->integer('articleimage_offset_right')->nullable()->comment('offset from right border if cropped');
			$table->integer('articleimage_offset_bottom')->nullable()->comment('offset from bottom border if cropped');
			$table->integer('articleimage_offset_left')->nullable()->comment('offset from left border if cropped');
			
			$table->softDeletes();
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
		Schema::drop('articleimages');
	}

}
