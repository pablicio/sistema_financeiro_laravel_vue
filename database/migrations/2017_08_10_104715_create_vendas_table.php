<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('cliente_id');
            $table->integer('conta_id');
            $table->integer('funcionario_id');

            $table->string('descricao')->nullable();
            $table->string('previsao_entrega')->nullable();
            $table->date('data_venda')->nullable();
            $table->decimal('valor_total');


            $table->softDeletes();
            $table->timestamps();

            $table->index('funcionario_id');
            $table->index('conta_id');
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
        Schema::dropIfExists('vendas');
    }
}
