<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Magazine;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Magazine::class, function (Faker $faker) {
    $publishersIDs = DB::table('publishers')->pluck('id');
    return [
        'name' => $faker->sentence(rand(1,3)),
        'publisher_id' => $faker->randomElement($publishersIDs->toArray())
    ];
});
