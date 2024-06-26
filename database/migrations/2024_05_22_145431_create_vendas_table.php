<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('forma_pagamento_id');
            $table->unsignedBigInteger('forma_envio_id');
            $table->enum('pago', ['S', 'N'])->default('S');
            $table->enum('cancelado', ['S', 'N'])->default('N');
            $table->timestamps();
            
            $table->foreign('usuario_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            
            $table->foreign('forma_pagamento_id')
                    ->references('id')
                    ->on('forma_pagamentos')
                    ->onDelete('cascade');
            
            $table->foreign('forma_envio_id')
                    ->references('id')
                    ->on('forma_envios')
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
        Schema::dropIfExists('vendas');
    }
}
