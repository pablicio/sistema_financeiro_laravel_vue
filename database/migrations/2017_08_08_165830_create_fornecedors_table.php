<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cidade_id');
            $table->integer('tipo_fornecedor_id');

            $table->string('nome')->nullable();
            $table->string('rg')->nullable();
            $table->string('data_nascimento')->nullable();
            $table->string('cpf')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('email')->nullable();
            $table->string('cep');
            $table->string('endereco');
            $table->string('bairro');
            $table->text('observacao')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('cidade_id');
            $table->index('tipo_fornecedor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedors');
    }
}
