<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'url' => 'https://' . $faker->word . '.com/' . $faker->word,
        'title' => $faker->sentence,
        'description' => $faker->paragraph(),
        'date' => $faker->unixTime,
        'image' => 'https://cdn.ghanasoccernet.com/2019/01/Boateng-Hapoel.jpg',
        'site' => $faker->word
    ];
});
