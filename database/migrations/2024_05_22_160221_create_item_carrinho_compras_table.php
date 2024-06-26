<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemCarrinhoComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_carrinho_compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('carrinho_compra_id');
            $table->unsignedBigInteger('produto_id');
            $table->integer('quantidade');
            $table->double('valor', 10, 2);
            $table->double('subtotal', 10, 2);
            $table->unsignedBigInteger('cupom_desconto_id')->nullable();
            $table->timestamps();
            
            $table->foreign('carrinho_compra_id')
                    ->references('id')
                    ->on('carrinho_compras')
                    ->onDelete('cascade');
            
            $table->foreign('produto_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');
            
            $table->foreign('cupom_desconto_id')
                    ->references('id')
                    ->on('cupom_descontos')
                    ->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_carrinho_compras');
    }
}
