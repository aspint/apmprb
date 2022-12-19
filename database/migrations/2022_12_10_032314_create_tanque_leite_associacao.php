<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanqueLeiteAssociacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanque_leite_associacao', function (Blueprint $table) {
            $table->unsignedBigInteger('fonte_id');
            $table->unsignedBigInteger('tipo_acao_leite_id')->nullable();
            $table->float('total_leite_acao')->nullable();
            $table->unsignedBigInteger('relacao_leite_cliente_empresa_id')->nullable();
            $table->unsignedBigInteger('relacao_leite_produtor_tanque_id')->nullable();
            $table->string('usuario')->nullable();
            $table->timestamp('datahora_inclusao')->nullable()->default(null);
            $table->timestamp('datahora_atualizacao')->nullable()->default(null);
            $table->foreign('fonte_id')->references('id')->on('fonte_tanque');
            $table->foreign('tipo_acao_leite_id')->references('id')->on('tipo_acao_leite');
            $table->foreign('relacao_leite_produtor_tanque_id')->references('id')->on('relacao_leite_produtor_tanque');
            $table->foreign('relacao_leite_cliente_empresa_id')->references('id')->on('relacao_leite_cliente_empresa');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanque_leite_associacao');
    }
}
