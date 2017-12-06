<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdotivosLogs extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('adotivos_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data')->index();
            $table->binary('adotivoJSON');
            $table->integer('adotivo_id');
            $table->char('adotivo_sexo', 1)->index();
            $table->integer('adotivo_etnia_id')->index();
            $table->integer('adotivo_status_id')->index();
            $table->integer('adotivo_idade')->index();
            # FK
            $table->integer('instituicao_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() 
    {
        Schema::dropIfExists('adotivos_logs');
    }
}
