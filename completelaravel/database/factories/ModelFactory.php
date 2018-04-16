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

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Post;
use App\Tag;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    static $email ='stevanris@gmail.com';
    return [
        'name' => $faker->name,
        'email' => $email,
        'password' => $password ?: $password = bcrypt('Steffi12'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(Category::class,function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});



$factory->define(Tag::class,function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(Post::class,function (Faker\Generator $faker) {

    return [
        'title' => $faker->word,
        'content' => $faker->text,
        'featured' => $faker->randomElement(['1.jpg','2.jpg','3.jpg']),
        'category_id' =>Category::all()->random()->id,
    ];
});