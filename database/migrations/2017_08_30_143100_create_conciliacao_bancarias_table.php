<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConciliacaoBancariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conciliacoes_bancarias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conta_bancaria_id');
            $table->integer('ofx_id');

            $table->integer('situacao_id');
            $table->string('tipo_deposito');
            $table->string('data_deposito');
            $table->string('fitid');
            $table->string('checknum');
            $table->text('memo');
            $table->decimal('valor');

            $table->timestamps();
            $table->softDeletes();

            $table->index('situacao_id');
            $table->index('conta_bancaria_id');
            $table->index('ofx_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conciliacao_bancarias');
    }
}
