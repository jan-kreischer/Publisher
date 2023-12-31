<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriptions', function(Blueprint $table) {
			$table->increments('subscription_id');
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('user_id')->on('users')->comment('FK to authors user_id in users table');
			$table->integer('subscriber_id')->unsigned();
			$table->foreign('subscriber_id')->references('user_id')->on('users')->comment('FK to subscribers users_id in users table');
			
			$table->softDeletes();
			$table->timestamps();
			
			$table->unique(['author_id', 'subscriber_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subscriptions');
	}

}
