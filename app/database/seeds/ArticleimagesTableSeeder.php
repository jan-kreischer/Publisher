<?php
class ArticleimagesTableSeeder extends Seeder {
	public function run() {
		DB::table('articleimages')->delete();
		
		$articleimages = [
			[
				'article_id' => 1,
				'user_id' => 1,
				'articleimage_name' => 'first',
				'articleimage_extension' => 'jpg',
				'articleimage_width' => 1,
				'articleimage_height' => 1,
				'articleimage_size' => 1,	
			],
			
			[
				'article_id' => 1,
				'user_id' => 1,
				'articleimage_name' => 'second',
				'articleimage_extension' => 'jpg',
				'articleimage_width' => 1,
				'articleimage_height' => 1,
				'articleimage_size' => 1,	
			],
			
			[
				'article_id' => 1,
				'user_id' => 1,
				'articleimage_name' => 'third',
				'articleimage_extension' => 'jpg',
				'articleimage_width' => 1,
				'articleimage_height' => 1,
				'articleimage_size' => 1,
			],
			
			[
				'article_id' => 1,
				'user_id' => 1,
				'articleimage_name' => 'fourth',
				'articleimage_extension' => 'jpg',
				'articleimage_width' => 1,
				'articleimage_height' => 1,
				'articleimage_size' => 1,
			],
			
			[
			'article_id' => 2,
			'user_id' => 1,
			'articleimage_name' => 'first',
			'articleimage_extension' => 'jpg',
			'articleimage_width' => 1,
			'articleimage_height' => 1,
			'articleimage_size' => 1,
			],
		];
		
		DB::table('articleimages')->insert($articleimages);
	}
}
