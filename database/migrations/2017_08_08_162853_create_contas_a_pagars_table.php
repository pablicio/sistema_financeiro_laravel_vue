<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContasAPagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_a_pagar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_despesa_id');
            $table->integer('centro_de_custo_id');
            $table->integer('sub_tipo_pagamento_id');
            $table->integer('conta_id');

            $table->integer('fornecedor_id');

            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();

            $table->decimal('valor');
            $table->decimal('desconto')->nullable();
            $table->decimal('deducao')->nullable();
            $table->decimal('juros')->nullable();
            $table->decimal('acrescimos')->nullable();
            $table->string('descricao',2048)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('tipo_despesa_id');
            $table->index('centro_de_custo_id');
            $table->index('sub_tipo_pagamento_id');
            $table->index('fornecedor_id');
            $table->index('conta_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas_a_pagars');
    }
}
