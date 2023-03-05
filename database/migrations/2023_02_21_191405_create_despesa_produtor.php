<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesaProdutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesa_produtor', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->float('valor_despesa');
            $table->timestamp('datahora_inclusao')->nullable()->default(null);
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
        Schema::dropIfExists('despesa_produtor');
    }
}
