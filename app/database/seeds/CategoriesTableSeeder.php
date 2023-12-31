<?php 
class CategoriesTableSeeder extends Seeder {
	public function run() {
		DB::table('categories')->delete();
		
		$categories = array(
		array(
			'category_name' => 'General'
		),
				
		array(
			'category_name' => 'Sports'
		),
				
		array(
			'category_name' => 'Health'				
		),
				
		array(
			'category_name' => 'Culture'
		),
				
		array(
			'category_name' => 'Technology'	
		),

		array(
			'category_name' => 'Science'
		),
				
		array(
			'category_name' => 'Politics'
		),
		array(
			'category_name' => 'News'
		)
		);
		
		DB::table('categories')->insert($categories);
	}
}