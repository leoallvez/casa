<?php

use Illuminate\Database\Seeder;

class EtniasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	$etnias = [
    		['nome' => 'Branco(a)'], 
            ['nome' => 'Negro(a)'], 
            ['nome' => 'Indígena'], 
            ['nome' => 'Mulato(a)'],
            ['nome' => 'Caboclo(a)'],
            ['nome' => 'Cafuzo(a)'],
            ['nome' => 'Pardo(a)']
    	];
    	DB::table('etnias')->insert($etnias);
    }
}
