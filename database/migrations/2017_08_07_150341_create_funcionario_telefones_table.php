<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionarioTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios_telefones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('telefone',20);
            $table->integer('funcionario_id');

            $table->softDeletes();
            $table->timestamps();

            $table->index('funcionario_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionario_telefones');
    }
}
