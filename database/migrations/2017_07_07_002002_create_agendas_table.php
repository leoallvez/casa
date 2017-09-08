<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dia');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->string('status');
            $table->text('opiniao_adotantes')->nullable();
            $table->text('opiniao_adotivos')->nullable();
            $table->text('observacoes')->nullable();
            # FK
            $table->integer('usuario_id');
            $table->integer('instituicao_id');
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
        Schema::dropIfExists('agendas');
    }
}
