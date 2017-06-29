<?php

use Illuminate\Database\Seeder;

class RestricoesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	$restricoes = [ 
            ['nome' => 'Não'],
    		['nome' => 'Doença tratável'],
    		['nome' => 'Doença não tratável'],
    		['nome' => 'Deficiência física'],
    		['nome' => 'Deficiência mental'],
    		['nome' => 'Vírus HIV']
    	];
    	DB::table('restricoes')->insert($restricoes);
    }
}
