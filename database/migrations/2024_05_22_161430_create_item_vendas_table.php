<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_vendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('venda_id');
            $table->unsignedBigInteger('produto_id');
            $table->integer('quantidade');
            $table->double('preco_compra', 10, 2);
            $table->double('subtotal', 10, 2);
            $table->timestamps();
            
            $table->foreign('venda_id')
                    ->references('id')
                    ->on('vendas')
                    ->onDelete('cascade');
            
            $table->foreign('produto_id')
                    ->references('id')
                    ->on('products')
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
        Schema::dropIfExists('item_vendas');
    }
}
