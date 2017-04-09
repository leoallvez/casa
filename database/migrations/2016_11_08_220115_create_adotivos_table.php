<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdotivosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('adotivos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome')->index();
            $table->char('sexo', 1);
            $table->date('nascimento');
            $table->date('data_chegada');
            $table->boolean('has_irmaos')->default(false);
            $table->date('data_adocao')->nullable();
            # FK
            $table->integer('escolaridade_id')->default(1);
            $table->integer('instituicao_id');
            $table->integer('usuario_id');
            $table->integer('etnia_id');
            $table->integer('status_id');
            $table->integer('nascionalidade_id');
            $table->integer('restricao_id')->default(1);

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
        Schema::dropIfExists('adotivos');
    }
}
