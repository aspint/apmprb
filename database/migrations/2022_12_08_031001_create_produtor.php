<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtor', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('cpf_cnpj', 14)->nullable();
            $table->string('rg',100)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->unsignedBigInteger('tipo_produtor_id');
            $table->bigInteger('inscricao')->unique();
            $table->unsignedBigInteger('endereco_id');
            $table->timestamp('datahora_inclusao')->nullable()->default(null);
            $table->timestamp('datahora_atualizacao')->nullable()->default(null);
            $table->string('usuario');
            $table->foreign('tipo_produtor_id')->references('id')->on('tipo_produtor');
            $table->foreign('endereco_id')->references('id')->on('endereco');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtor');
    }
}
