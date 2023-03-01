<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPagamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_pagamento', function (Blueprint $table) {
            $table->id();
            $table->string('valor');
            $table->string('descricao')->nullable();
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
        Schema::dropIfExists('status_pagamento');
    }
}
