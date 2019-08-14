<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cidade_id');
            $table->integer('tipo_perfil_id');


            $table->string('nome');
            $table->string('email')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('cpf',15)->nullable();
            $table->string('cep',10);
            $table->string('endereco');
            $table->string('bairro');

            $table -> index('cidade_id');
            $table -> index('tipo_perfil_id');


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
        Schema::dropIfExists('funcionarios');
    }
}
