<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('user_id');
			$table->string('user_str')->nullable()->comment('like Jan.Bauer75 on FB');
			$table->string('first_name');
			$table->string('last_name');
			$table->enum('user_gender', ['m', 'f']);
			$table->string('email_address');
			$table->boolean('email_confirmed')->default('0');
			$table->string('email_confirmation_code')->nullable();
			$table->string('password');
			//$table->string('profile_picture_path');
			//$table->integer('score')->unsigned()->default('0');
			
			$table->softDeletes();
			$table->rememberToken();
			$table->timestamps();
			
			$table->integer('language_id')->unsigned()->default('1')->references('language_id')->on('languages');
			$table->integer('country_id')->unsigned()->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
