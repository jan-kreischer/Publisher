<?php 
class UsersTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();
		
		$users = array(		
		array(
			'first_name' => 'Jan',
			'last_name' => 'Bauer',
			'user_gender' => 'm',
			'email_address' => 'jan.kr.bauer@gmail.com',
			'password' => Hash::make('JanBauer'),
			'email_confirmation_code' => NULL,
			'email_confirmed' => TRUE,
			),
		array(
			'first_name' => 'Jana',
			'last_name' => 'Bauer',
			'user_gender' => 'm',
			'email_address' => 'jana.kr.bauer@gmail.com',
			'password' => Hash::make('JanaBauer'),
			'email_confirmation_code' => str_random(32),
		),
		array(
			'first_name' => 'Marcel',
			'last_name' => 'Wolle',
			'user_gender' => 'm',
			'email_address' => 'marcelwolle.mw@gmail.com',
			'password' => Hash::make('mjmwolle01'),
			'email_confirmation_code' => str_random(32),
			),	
		array(
			'first_name' => 'Bernd',
			'last_name' => 'Wüstholz',
			'user_gender' => 'm',
			'email_address' => 'b_wuestholz@web.de',
			'password' => Hash::make('BerndWüstholz'),
			'email_confirmation_code' => str_random(32),
			),
		array(
			'first_name' => 'Axel',
			'last_name' => 'Autenrieth',
			'user_gender' => 'm',
			'email_address' => 'axel.autenrieth@web.de',
			'password' => Hash::make('123456'),
			'email_confirmation_code' => str_random(32),				
			),
		array(
			'first_name' => 'Jan',
			'last_name' => 'Kreischer',
			'user_gender' => 'm',
			'email_address' => 'jan.kreischer@gmail.com',
			'password' => Hash::make('JanKreischer'),
			'email_confirmation_code' => str_random(32),
			),
		);
		
		DB::table('users')->insert($users);
	}
}