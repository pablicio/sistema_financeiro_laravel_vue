<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConciliacaoContasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conciliacoes_contas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conciliacao_id');
            $table->integer('conta_pagar_id')->nullable();
            $table->integer('conta_receber_id')->nullable();

            $table->index('conciliacao_id');
            $table->index('conta_pagar_id');
            $table->index('conta_receber_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conciliacao_contas');
    }
}
