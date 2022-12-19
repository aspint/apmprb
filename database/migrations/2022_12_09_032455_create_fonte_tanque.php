<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFonteTanque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fonte_tanque', function (Blueprint $table) {
            $table->id();
            $table->string('fonte_valor')->unique();
            $table->string('fonte_descricao');
            $table->float('total_leite');
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
        Schema::dropIfExists('fonte_tanque');
    }
}
