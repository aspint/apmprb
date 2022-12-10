<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacaoLeiteClienteEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacao_leite_cliente_empresa', function (Blueprint $table) {
            $table->id();
            $table->date('data_entrega');
            $table->float('qntd_litros_entregue');
            $table->unsignedBigInteger('periodo_id');
            $table->unsignedBigInteger('cliente_empresa_id');
            $table->unsignedBigInteger('valor_leite_mensal_id');
            $table->timestamp('datahora_inclusao')->nullable()->default(null);
            $table->timestamp('datahora_atualizacao')->nullable()->default(null);
            $table->string('usuario')->nullable();
            $table->foreign('cliente_empresa_id')->references('id')->on('cliente_empresa');
            $table->foreign('valor_leite_mensal_id')->references('id')->on('valor_leite_mensal');
            $table->foreign('periodo_id')->references('id')->on('periodo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relacao_leite_cliente_empresa');
    }
}
