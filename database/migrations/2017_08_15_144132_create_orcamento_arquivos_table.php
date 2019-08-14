<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrcamentoArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos_arquivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orcamento_id')->nullable();
            $table->string('link');
            $table->string('nome');

            $table->timestamps();
            $table->softDeletes();

            $table->index('orcamento_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orcamento_arquivos');
    }
}
