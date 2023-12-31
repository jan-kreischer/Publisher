<?php 
class SubscriptionsTableSeeder extends Seeder {
	public function run() {
		DB::table('subscriptions')->delete();
		
		$subscriptions = array(		
			[
				'author_id' => 1,
				'subscriber_id' => 2,	
			],

			[
				'author_id' => 1,
				'subscriber_id' => 3,
			],
				
			[
				'author_id' => 2,
				'subscriber_id' => 1,
			],
				
			[
				'author_id' => 3,
				'subscriber_id' => 1,
			],
		);
		
		DB::table('subscriptions')->insert($subscriptions);
	}
}
