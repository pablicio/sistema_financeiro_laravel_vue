<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecebimentoOrcamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos_recebimentos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cliente_id');
            $table->integer('orcamento_id');
            $table->integer('forma_de_pagamento_id')->nullable();

            $table->integer('banco_id')->nullable();
            $table->integer('cartao_id')->nullable();

            $table->decimal('valor')->nullable();


            $table->decimal('desconto')->nullable();
            $table->decimal('deducao')->nullable();
            $table->decimal('juros')->nullable();
            $table->decimal('acrescimos')->nullable();

            $table->decimal('valor_parcelado')->nullable();
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->string('nosso_numero')->nullable();
            $table->string('carteira')->nullable();
            $table->integer('total_parcelas')->nullable();
            $table->decimal('parcela')->nullable();
            $table->string('numero_cheque')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('banco_id');
            $table->index('cartao_id');
            $table->index('orcamento_id');
            $table->index('cliente_id');
            $table->index('forma_de_pagamento_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orcamentos_recebimentos');
    }
}
