<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrcamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id');
            $table->integer('funcionario_id');

            $table->text('descricao');
            $table->text('formas_pagamento');
            $table->string('previsao_entrega');
            $table->string('validade_orcamento');
            $table->date('data_venda');
            $table->decimal('valor_total');

            $table->softDeletes();
            $table->timestamps();

            $table->index('funcionario_id');
            $table->index('cliente_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orcamentos');
    }
}
