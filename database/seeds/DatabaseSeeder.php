<?php

use Illuminate\Database\Seeder;
use App\Author;
use App\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		
		DB::statement("SET foreign_key_checks=0");
		Author::truncate();
		DB::statement("SET foreign_key_checks=1");
		
		factory('App\Author', 10)->create();
		
		DB::statement("SET foreign_key_checks=0");
		Book::truncate();
		DB::statement("SET foreign_key_checks=1");
		
		factory('App\Book', 50)->create()->each(function($book) {
			
			$authorIds = Author::lists('id');
			
			$book->authors()->sync($authorIds->random(rand(2,4))->all());
		});
    }
}
