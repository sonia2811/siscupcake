<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CarrinhoCompra;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(CarrinhoCompra::class, function (Faker $faker) {
    return [
        'usuario_id' => factory(User::class),
        'criado_em' => date()
    ];
});
