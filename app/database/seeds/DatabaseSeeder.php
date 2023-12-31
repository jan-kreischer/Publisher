<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->call('ArticlesTableSeeder');
		$this->call('CategoriesTableSeeder');
		$this->call('CommentsTableSeeder');
		$this->call('SubscriptionsTableSeeder');
		$this->call('LanguagesTableSeeder');
		$this->call('ArticleimagesTableSeeder');
		$this->call('CountriesTableSeeder');
	}

}
