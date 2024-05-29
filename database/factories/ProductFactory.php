<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'nome' => $faker->unique()->name,
        'descricao' => $faker->sentence,
        'valor' => 12.9,
        'ingredientes' => $faker->text,
        'foto' => 'products/kWNxzm3vK72ph4P4dhc7NQcMB6azEM3XxWFp7pU0.jpg',
    ];
});
