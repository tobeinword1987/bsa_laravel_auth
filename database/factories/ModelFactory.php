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
        'firstname' => $faker->firstName,
        'email' => $faker->safeEmail,
        'lastname' => $faker->lastName,
    ];
});
$factory->define(App\Book::class, function (Faker\Generator $faker) {
    return [
        'title' =>  $faker->word ,
        'author' =>  $faker->word ,
        'year' =>  $faker->randomNumber() ,
        'genre' =>  $faker->word ,
        'user_id' =>  random_int(DB::table('users')->min('id'),DB::table('users')->max('id'))
    ];
});

