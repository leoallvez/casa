<?php

use Illuminate\Database\Seeder;

class EstadosCivisTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        $estadosCivis = [
        	['nome' => 'Solteiro(a)'],
        	['nome' => 'Casado(a)'],
        	['nome' => 'Divorciado(a)'],
        	['nome' => 'Viúvo(a)'],
        	['nome' => 'Separado(a)'],
        	['nome' => 'União estável']
        ];
        DB::table('estados_civis')->insert($estadosCivis);
    }
}
