<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'image_location' => $faker->word,
        'description' => $faker->sentence,
        'category_id' => factory(Category::class)
    ];
});
