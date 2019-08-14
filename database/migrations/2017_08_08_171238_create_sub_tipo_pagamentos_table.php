<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubTipoPagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_tipos_pagamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->integer('tipo_pagamento_id');

            $table->timestamps();
            $table->softDeletes();

            $table->index('tipo_pagamento_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_tipo_pagamentos');
    }
}
