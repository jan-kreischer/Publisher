<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserimagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userimages', function(Blueprint $table) {
			$table->increments('userimage_id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('user_id')->on('users');
			$table->string('userimage_name')->comment('filename without extension. required');
			$table->string('userimage_extension')->comment('file extension. required');
			$table->integer('userimage_size')->comment('size of the file in bytes. required');
			$table->string('userimage_width')->comment('width of the file. required');
			$table->integer('userimage_height')->comment('height of the file. required');
			$table->string('userimage_description')->nullable()->comment('description of the file. optional');
			$table->integer('userimage_offset_top')->nullable()->comment('offset from top border if cropped');
			$table->integer('userimage_offset_right')->nullable()->comment('offset from right border if cropped');
			$table->integer('userimage_offset_bottom')->nullable()->comment('offset from bottom border if cropped');
			$table->integer('userimage_offset_left')->nullable()->comment('offset from left border if cropped');
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
		Schema::drop('userimages');
	}

}
