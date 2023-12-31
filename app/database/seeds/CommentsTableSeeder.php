<?php 
class CommentsTableSeeder extends Seeder {
	public function run() {
		DB::table('comments')->delete();
		
		$comments = array(		
			array(
				'user_id' => '1',
				'article_id' => '1',
				'comment_content' => 'Comment User 1 Article 1 ',
				'approved' => '1'
			),
					
			array(
				'user_id' => '1',
				'article_id' => '2',
				'comment_content' => 'Comment User 1 Article 2',
				'approved' => '1'			
			),
					
			array(
				'user_id' => '1',
				'article_id' => '3',
				'comment_content' => 'Comment User 1 Article 3',
				'approved' => '1'
			),
			array(
				'user_id' => '2',
				'article_id' => '1',
				'comment_content' => 'Comment User 2 Article 1',
				'approved' => '1'
			),
					
			array(
				'user_id' => '1',
				'article_id' => '2',
				'comment_content' => 'Comment User 2 Article 2',
				'approved' => '1'
			),
					
			array(
				'user_id' => '1',
				'article_id' => '3',
				'comment_content' => 'Comment User 2 Article 3',
				'approved' => '1'
			),
		);
		
		DB::table('comments')->insert($comments);
	}
}