<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ItemCarrinhoCompra;
use App\Models\CarrinhoCompra;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(ItemCarrinhoCompra::class, function (Faker $faker) {
    return [
        'carrinho_compra_id' => factory(CarrinhoCompra::class),
        'produto_id' => factory(Product::class),
        'quantidade' => 1,
        'valor' => 12.9,
        'subtotal' => 12.9,
        'cupom_desconto_id' => null
    ];
});
