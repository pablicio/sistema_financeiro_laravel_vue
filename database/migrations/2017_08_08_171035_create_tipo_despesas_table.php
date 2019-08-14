<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_despesas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->integer('unidade_id');

            $table->timestamps();
            $table->softDeletes();

            $table->index('unidade_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_despesas');
    }
}
