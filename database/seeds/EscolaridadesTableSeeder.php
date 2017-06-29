<?php

use Illuminate\Database\Seeder;

class EscolaridadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $escolaridades = [
        	['nome' => 'Não Alfabetizado'],
        	['nome' => 'Ensino Fundamental Incompleto'],
        	['nome' => 'Ensino Fundamental Completo'],
        	['nome' => 'Ensino Médio Incompleto'],
        	['nome' => 'Ensino Médio Completo'],
        	['nome' => 'Ensino Superior Incompleto'],
        	['nome' => 'Ensino Superior Completo'],
        	['nome' => 'Mestrado'],
        	['nome' => 'Doutorado']
        ];
        DB::table('escolaridades')->insert($escolaridades);
    }
}
