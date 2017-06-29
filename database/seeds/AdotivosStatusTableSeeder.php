<?php

use Illuminate\Database\Seeder;

class AdotivosStatusTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
     	$status = [
     		['nome' => 'Indisponível para Adoção'],
	        ['nome' => 'Disponível para Adoção'], 
	        ['nome' => 'Recebendo Visitas'], 
	        ['nome' => 'Guarda Provisória'], 
	        ['nome' => 'Adotado(a)'],
	        ['nome' => 'Completou Maior Idade']
        ];
        DB::table('adotivos_status')->insert($status);
    }
}
