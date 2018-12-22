<?php

use Faker\Generator as Faker;
use App\Thread;

/**
 * @var $factory \Illuminate\Database\Eloquent\Factory
 */
$factory->define(Thread::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});
