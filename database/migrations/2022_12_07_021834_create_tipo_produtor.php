<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProdutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_produtor', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_valor',50)->unique();
            $table->string('desc_valor',50);
            $table->timestamp('datahora_inclusao')->nullable()->default(null);
            $table->timestamp('datahora_atualizacao')->nullable()->default(null);
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
        Schema::dropIfExists('tipo_produtor');
    }
}
