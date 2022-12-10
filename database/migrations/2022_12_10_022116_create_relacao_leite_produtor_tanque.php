<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacaoLeiteProdutorTanque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacao_leite_produtor_tanque', function (Blueprint $table) {
            $table->id();
            $table->date('data_entrega');
            $table->float('qntd_litros_entregue');
            $table->unsignedBigInteger('periodo_id');
            $table->foreign('periodo_id')->references('id')->on('periodo');
            $table->unsignedBigInteger('produtor_id');
            $table->foreign('produtor_id')->references('id')->on('produtor');
            $table->timestamp('datahora_inclusao')->nullable()->default(null);
            $table->timestamp('datahora_atualizacao')->nullable()->default(null);
            $table->unsignedBigInteger('valor_leite_mensal_id');
            $table->foreign('valor_leite_mensal_id')->references('id')->on('valor_leite_mensal');
            $table->string('usuario')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relacao_leite_produtor_tanque');
    }
}
