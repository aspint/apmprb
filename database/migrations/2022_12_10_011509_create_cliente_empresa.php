<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('nome_razao_social');
            $table->string('cpf_cnpj',14)->nullable();
            $table->unsignedBigInteger('endereco_id')->nullable()->unique();
            $table->foreign('endereco_id')->references('id')->on('endereco');
            $table->timestamp('datahora_inclusao')->nullable()->default(null);
            $table->timestamp('datahora_atualizacao')->nullable()->default(null);
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
        Schema::dropIfExists('cliente_empresa');
    }
}
