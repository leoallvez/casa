<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdotantesAdotivosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('adotantes_adotivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adotante_id');
            $table->integer('adotivo_id');
            $table->string('observacoes', 700)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('adotantes_adotivos');
    }
}
