<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdotantesTable extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('adotantes', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('nome')->index();
            $table->char('sexo', 1);
            $table->date('nascimento');
            $table->string('cpf')->index();
            $table->string('rg');
            $table->string('endereco');
            $table->string('endereco_numero');
            $table->string('complemento');
            $table->string('cep');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('telefone');
            $table->string('celular');
            $table->string('email');
            $table->boolean('tem_vinculo')->default(false);
            # Conjuge.
            $table->string('conjuge_nome')->nullable()->index();
            $table->char('conjuge_sexo', 1)->nullable();
            $table->date('conjuge_nascimento')->nullable();          
            $table->string('conjuge_cpf')->nullable()->index();
            $table->string('conjuge_rg')->nullable();
            $table->integer('conjuge_escolaridade_id')->nullable();
            $table->integer('conjuge_nascionalidade_id')->nullable();
            $table->integer('conjuge_categoria_profissional_id')->nullable();
            #FK
            $table->integer('estado_id');
            $table->integer('usuario_id');
            $table->integer('estado_civil_id')->default(1);
            $table->integer('instituicao_id');
            $table->integer('nacionalidade_id')->default(1);
            $table->integer('escolaridade_id')->nullable();
            $table->integer('categoria_profissional_id')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('adotantes');
    }
}
