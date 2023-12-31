<?php 
class LanguagesTableSeeder extends Seeder {
	public function run() {
		DB::table('languages')->delete();
		
		$languages = array(		
			[
				'language_id' => 1,
				'language_code' => 'en',
				'language_name' => 'english',	
			],

			[
				'language_id' => 2,
				'language_code' => 'de',
				'language_name' => 'german',	
			],
				
			[
				'language_id' => 3,
				'language_code' => 'it',
				'language_name' => 'italian',	
			],
				
			[
				'language_id' => 4,
				'language_code' => 'fr',
				'language_name' => 'french',	
			],
				
			[
				'language_id' => 5,
				'language_code' => 'es',
				'language_name' => 'spanish',
			],
			
			[
				'language_id' => 6,
				'language_code' => 'pt',
				'language_name' => 'portuguese',
			],
				
			[
				'language_id' => 7,
				'language_code' => 'ru',
				'language_name' => 'russian',
			],
		);
		
		DB::table('languages')->insert($languages);
	}
}