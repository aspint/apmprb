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
            $table->string('capf_cnpj',14)->nullable;
            $table->string('rg',100)->nullable;
            $table->date('data_nascimento')->nullable;
            $table->foreign('tipo_cooperativa_id')->references('id')->on('tipo_cooperativa');
            $table->bigInteger('inscricao')->unique();
            $table->timestamps('data_inclusao')->nullable;
            $table->timestamps('data_atualizacao')->nullable;
            $table->string('telefone', 20)->nullable;

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
