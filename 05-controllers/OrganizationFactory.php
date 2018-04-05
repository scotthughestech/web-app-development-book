<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Organization::class, function (Faker $faker) {
    return [
        'user_id' => array_random(User::pluck('id')->toArray()),
        'name' => $faker->company,
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => $faker->postcode,
        'country' => 'United States',
        'phone' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
        'website' => 'http://www.' . $faker->domainName,
        'type_id' => $faker->numberBetween(1, 3),
        'notes' => $faker->sentences(3, true)
    ];
});
