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
$factory->define(QMagico\Entities\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'group_id' => $faker->numberBetween($min = 1, $max = 2),
    ];
});

// Group Entitie
$factory->define(QMagico\Entities\Group::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

// Admin Group
$factory->state(QMagico\Entities\Group::class, 'admin', function($faker) {
    return [
        'name' => 'Administrador',
    ];
});

// Student Group
$factory->state(QMagico\Entities\Group::class, 'student', function($faker) {
    return [
        'name' => 'Estudante',
    ];
});


