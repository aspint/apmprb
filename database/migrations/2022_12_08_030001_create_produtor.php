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
            $table->unsignedBigInteger('tipo_produtor_id')->nullable();
            $table->bigInteger('inscricao')->unique();
            $table->timestamp('datahora_inclusao')->nullable()->default(null);
            $table->timestamp('datahora_atualizacao')->nullable()->default(null);
            $table->string('usuario')->nullable();
            $table->foreign('tipo_produtor_id')->references('id')->on('tipo_produtor');
            $table->unsignedBigInteger('users_id')->nullable()->default(null)->unique();
            $table->foreign('users_id')->references('id')->on('users')->nullable();
            $table->unsignedBigInteger('endereco_id')->nullable()->default(null);
            $table->foreign('endereco_id')->references('id')->on('endereco')->nullable();
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
