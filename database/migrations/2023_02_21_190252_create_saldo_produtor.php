<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldoProdutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldo_produtor', function (Blueprint $table) {
            $table->id();
            $table->float('saldo');
            $table->timestamp('datahora_alteracao')->nullable()->default(null);
            $table->unsignedBigInteger('produtor_id');
            $table->foreign('produtor_id')->references('id')->on('produtor');
            $table->string('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saldo_produtor');
    }
}
