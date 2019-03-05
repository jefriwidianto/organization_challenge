<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Printerous\User::class, function () {
    $faker = \Faker\Factory::create('id_ID');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'jabatan' => $faker->numberBetween(1,2),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(Printerous\Organization::class, function () {
	$faker = \Faker\Factory::create('id_ID');
    return [
        'name' => $faker->name,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->unique()->companyEmail,
        'website' => $faker->domainName,
        'company' => $faker->company,
        'id_accountmgr' => $faker->numberBetween(1,3),
        'logo' => $faker->name.'.jpg',
    ];
});

$factory->define(Printerous\Person::class, function () {
    $faker = \Faker\Factory::create('id_ID');
    return [
        'name' => $faker->name,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->unique()->companyEmail,
        'id_organization' => $faker->numberBetween(1,50),
        'avatar' => $faker->name.'.jpg',
    ];
});