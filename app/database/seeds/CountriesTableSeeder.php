<?php 
class CountriesTableSeeder extends Seeder {
	public function run() {
		DB::table('countries')->delete();
		
		$countries = array(		
			[
				'country_id' => 1,
				'country_code' => 'US',
				'country_name' => 'united states',	
			],

			[
				'country_id' => 2,
				'country_code' => 'DE',
				'country_name' => 'germany',	
			],
				
			[
				'country_id' => 3,
				'country_code' => 'IT',
				'country_name' => 'Italiy',	
			],
				
			[
				'country_id' => 4,
				'country_code' => 'FR',
				'country_name' => 'france',	
			],
				
			[
				'country_id' => 5,
				'country_code' => 'ES',
				'country_name' => 'spain',
			],
			
			[
				'country_id' => 6,
				'country_code' => 'PT',
				'country_name' => 'portugal',
			],
				
			[
				'country_id' => 7,
				'country_code' => 'RU',
				'country_name' => 'russia',
			],
			
			[
				'country_id' => 8,
				'country_code' => 'GB',
				'country_name' => 'united kingdom',
			],
		);
		
		DB::table('countries')->insert($countries);
	}
}