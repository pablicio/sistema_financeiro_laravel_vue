<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores_telefones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('telefone',20);
            $table->integer('fornecedor_id');

            $table->softDeletes();
            $table->timestamps();

            $table->index('fornecedor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedor_telefones');
    }
}
