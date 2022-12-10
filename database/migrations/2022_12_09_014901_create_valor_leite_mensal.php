<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorLeiteMensal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_leite_mensal', function (Blueprint $table) {
            $table->id();
            $table->timestamp('data_inclusao');
            $table->date('data_referencia');
            $table->float('valor_bruto');
            $table->float('valor_liquido');
            $table->unsignedBigInteger('tipo_produtor_id');
            $table->foreign('tipo_produtor_id')->references('id')->on('tipo_produtor');
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
        Schema::dropIfExists('valor_leite_mensal');
    }
}
