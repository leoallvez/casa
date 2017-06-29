<?php

use Illuminate\Database\Seeder;

class NascionalidadesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	$nascionalidades = [
            ['nome' => 'Brasileiro'],
    		['nome' => 'Albanês'],
    		['nome' => 'Alemão'],
    		['nome' => 'Austríaco'],
    		['nome' => 'Belga'],
    		['nome' => 'Búlgaro'],
    		['nome' => 'Croata'],
    		['nome' => 'Cipriota'],
    		['nome' => 'Dinamarquês'],
    		['nome' => 'Eslovaco'],
    		['nome' => 'Esloveno'],
    		['nome' => 'Espanhol'],
    		['nome' => 'Francês'],
    		['nome' => 'Finlandês'],
    		['nome' => 'Grego'],
    		['nome' => 'Húngaro'],
    		['nome' => 'Islandês'],
    		['nome' => 'Irlandês'],
    		['nome' => 'Italiano'],
    		['nome' => 'Kosovar'],
    		['nome' => 'Lituano'],
    		['nome' => 'Luxemburguês'],
            ['nome' => 'Montenegrino'],
            ['nome' => 'Holandês'],
            ['nome' => 'Norueguês'],
            ['nome' => 'Polaco'],
            ['nome' => 'Português'],
            ['nome' => 'Inglês'],
            ['nome' => 'Romenos'],
            ['nome' => 'Russo'],
            ['nome' => 'Sueco'],
            ['nome' => 'Suíço'],
            ['nome' => 'Turco'],
            ['nome' => 'Ucraniano'],
            ['nome' => 'Argentino'],
            ['nome' => 'Canadiano'],
            ['nome' => 'Chileno'],
            ['nome' => 'Colombiano'],
            ['nome' => 'Cubano'],
            ['nome' => 'Americano'],
            ['nome' => 'Mexicano'],
            ['nome' => 'Venezuelano'],
            ['nome' => 'Afegão'],
            ['nome' => 'Chinês'],
            ['nome' => 'Indiano'],
            ['nome' => 'Indonésio'],
            ['nome' => 'Iraniano'],
            ['nome' => 'Iraquiano'],
            ['nome' => 'Israelita'],
            ['nome' => 'Japonês'],
            ['nome' => 'Libanês'],
            ['nome' => 'Paquistanês'],
            ['nome' => 'Sírio'],
            ['nome' => 'Tailandês'],
            ['nome' => 'Vietnamita'],
            ['nome' => 'Sul-africano'],
            ['nome' => 'Angolano'],
            ['nome' => 'Queniano'],
            ['nome' => 'Líbio'],
            ['nome' => 'Marroquino'],
            ['nome' => 'Moçambicano'],
            ['nome' => 'Nigeriano']
    	];
    	DB::table('nascionalidades')->insert($nascionalidades);
    }
}
