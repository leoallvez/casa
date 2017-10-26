<?php

use Illuminate\Database\Seeder;

class UsuarioNiveisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
    	$niveis = [
    		['nome' => 'Administrador Sistema'],
    		['nome' => 'Administrador Instituição'],
    		['nome' => 'Padrão'],
    		['nome' => 'Candidato']
    	];
    	DB::table('niveis_usuarios')->insert($niveis);
    }
}
