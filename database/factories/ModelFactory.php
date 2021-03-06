<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Book::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'isbn' => $faker->isbn10,
		'description' => $faker->paragraph(),
        'price' => rand(10,150), 
		'released_at' => $faker->date()
    ];
});

$factory->define(App\Author::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
		'middle_name' => $faker->name,
		'last_name' => $faker->lastName,
		'email' => $faker->email,
		'identity_number' => $faker->uuid
    ];
});