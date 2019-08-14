<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id');
            $table->integer('venda_id');
            $table->integer('quantidade')->nullable();
            $table->integer('produto_id')->nullable();
            $table->integer('servico_id')->nullable();

            $table->decimal('valor');

            $table->timestamps();
            $table->softDeletes();

            $table->index('cliente_id');
            $table->index('venda_id');
            $table->index('produto_id');
            $table->index('servico_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
