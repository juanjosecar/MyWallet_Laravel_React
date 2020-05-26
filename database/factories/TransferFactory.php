<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transfer;
use Faker\Generator as Faker;

$factory->define(Transfer::class, function (Faker $faker) {
    return [
        'description' => $faker->text($maxNoChars = 200),
        'amount' => $faker ->numberBetween($min = 500, $max = 900),
        'wallet_id' => $faker ->randomDigitNotNull
    ];
});
