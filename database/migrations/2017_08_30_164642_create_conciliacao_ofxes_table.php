<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConciliacaoOfxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conciliacoes_ofx', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ofx_name');
            $table->integer('banco_id');
            $table->decimal('balance', 10);

            $table->index('banco_id');

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
        Schema::dropIfExists('conciliacao_ofxes');
    }
}
