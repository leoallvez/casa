<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('instituicoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razao_social')->index();
            $table->boolean('is_aprovada');
            $table->string('cnpj')->index();
            $table->string('telefone');
            $table->string('endereco');
            $table->string('endereco_numero');
            $table->string('complemento');
            $table->string('cep');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('email');
            $table->text('observacoes')->nullable();
            #FK
            $table->integer('estado_id');

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
        Schema::dropIfExists('instituicoes');
    }
}
