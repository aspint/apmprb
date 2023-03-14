<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReciboPagamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo_pagamento', function (Blueprint $table) {
            $table->id();
            $table->float('valor_pago');
            $table->float('total_litros_pago');
            $table->date('periodo_inicio');
            $table->date('periodo_fim');
            $table->date('mes_referencia');
            $table->unsignedBigInteger('produtor_id');
            $table->foreign('produtor_id')->references('id')->on('produtor');
            $table->unsignedBigInteger('status_pagamento_id');
            $table->foreign('status_pagamento_id')->references('id')->on('status_pagamento');
            $table->timestamp('datahora_inclusao')->nullable()->default(null);
            $table->timestamp('datahora_atualizacao')->nullable()->default(null);
            $table->unsignedBigInteger('status_recibo_id');
            $table->foreign('status_recibo_id')->references('id')->on('status_recibo');
            $table->string('usuario')->nullable();
            $table->unique('mes_referencia','produtor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibo_pagamento');
    }
}
