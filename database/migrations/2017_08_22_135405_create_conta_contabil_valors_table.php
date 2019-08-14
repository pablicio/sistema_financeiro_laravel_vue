<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContaContabilValorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_contabil_valores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conta_id');
            $table->integer('conta_pagar_id')->nullable();
            $table->integer('conta_receber_id')->nullable();
            $table->date('data_pagamento')->nullable();


            $table->decimal('valor');

            $table->softDeletes();

            $table->timestamps();

            $table->index('conta_id');
            $table->index('conta_pagar_id');
            $table->index('conta_receber_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conta_contabil_valors');
    }
}
