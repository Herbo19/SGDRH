<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('metas');
        Schema::create('metas', function (Blueprint $table) {
            $table->bigIncrements('idMeta');
            $table->string('atribuir_para');
            $table->string('atribuido_por');
            $table->date('data_criacao');
            $table->date('data_conclusao');
            $table->string('estado')->default('progresso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metas');
    }
};
