<?php

use Illuminate\Database\Seeder;

class CategoriasProfissionaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        $categorias = [
        	['nome' => 'Empregado(a) de empresa do setor privado'],
        	['nome' => 'Empregado(a) de organização não-governamental'],
        	['nome' => 'Profissional liberal'],
        	['nome' => 'Autônomo(a)'],
        	['nome' => 'Proprietário(a) de empresa'],
        	['nome' => 'Servidor(ra) público(a)'],
        	['nome' => 'Aposentado(a)'],
        	['nome' => 'Estágiario(a)'],
        	['nome' => 'Desempregado(a)'],
            ['nome' => 'Dona(o) de casa']
        ];
        DB::table('categorias_profissionais')->insert($categorias);
    }
}
