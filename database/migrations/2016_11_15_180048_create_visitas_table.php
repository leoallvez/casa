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
            $table->string('hora');
            $table->string('tempo_estimado');
            $table->text('observacoes');
            #FK
            $table->integer('instituicao_id');
            $table->integer('adotivo_id');
            $table->integer('adotante_id');

            $table->softDeletes();
            $table->timestamps();
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
