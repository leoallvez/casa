<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('visitas', function (Blueprint $table) {
            $table->increments('id'); 
            $table->date('dia');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->string('status');
            $table->text('opiniao_adotantes')->nullable();
            $table->text('opiniao_adotivos')->nullable();
            $table->text('observacoes')->nullable();
            # FK
            $table->integer('instituicao_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('visitas');
    }
}
