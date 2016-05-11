<?php

use App\Genre;
use Carbon\Carbon;
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
		
		Genre::truncate();
		$now = Carbon::now('utc')->toDateTimeString();
		$genres = [
			[
				'title' => 'Horror',
				'description' => 'Description Description Description Description Description Description Description ',
				'created_at' => $now,
				'updated_at' => $now
			],
			[
				'title' => 'Fiction',
				'description' => 'Description Description Description Description Description Description Description ',
				'created_at' => $now,
				'updated_at' => $now
			],
			[
				'title' => 'Non-fiction',
				'description' => 'Description Description Description Description Description Description Description ',
				'created_at' => $now,
				'updated_at' => $now
			],
			[
				'title' => 'Academic',
				'description' => 'Description Description Description Description Description Description Description ',
				'created_at' => $now,
				'updated_at' => $now
			],
			[
				'title' => 'Love',
				'description' => 'Description Description Description Description Description Description Description ',
				'created_at' => $now,
				'updated_at' => $now
			],
			[
				'title' => 'Economics',
				'description' => 'Description Description Description Description Description Description Description ',
				'created_at' => $now,
				'updated_at' => $now
			],
		];
		Genre::insert($genres);
		
		DB::statement("SET foreign_key_checks=0");
		DB::table('author_book')->truncate();
		DB::statement("SET foreign_key_checks=1");
		
		DB::statement("SET foreign_key_checks=0");
		Author::truncate();
		DB::statement("SET foreign_key_checks=1");
		
		factory('App\Author', 20)->create();
		
		DB::statement("SET foreign_key_checks=0");
		Book::truncate();
		DB::statement("SET foreign_key_checks=1");
		
		factory('App\Book', 100)->create()->each(function($book) {
			
			$authorIds = Author::lists('id');
			$genreIds = Genre::lists('id');
			
			$book->genre_id = $genreIds->random();
			$book->save();
			
			$book->authors()->sync($authorIds->random(rand(2,4))->all());
		});
    }
}
