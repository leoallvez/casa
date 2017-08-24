<?php

use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $estados = [
            ["UF" => "SP", "nome" => "São Paulo"],
            ["UF" => "AC", "nome" => "Acre"],
            ["UF" => "AL", "nome" => "Alagoas"],
            ["UF" => "AM", "nome" => "Amazonas"],
            ["UF" => "AP", "nome" => "Amapá"],
            ["UF" => "BA", "nome" => "Bahia"],
            ["UF" => "CE", "nome" => "Ceara"],
            ["UF" => "DF", "nome" => "Distrito Federal"],
            ["UF" => "ES", "nome" => "Espírito Santo"],
            ["UF" => "GO", "nome" => "Goiás"],
            ["UF" => "MA", "nome" => "Maranhão"],
            ["UF" => "MT", "nome" => "Mato Grosso"],
            ["UF" => "MS", "nome" => "Mato Grosso do Sul"],
            ["UF" => "MG", "nome" => "Minas Gerais"],
            ["UF" => "PA", "nome" => "Pará"],
            ["UF" => "PB", "nome" => "Paraíba"],
            ["UF" => "PR", "nome" => "Paraná"],
            ["UF" => "PE", "nome" => "Pernambuco"],
            ["UF" => "PI", "nome" => "Piauí"],
            ["UF" => "RJ", "nome" => "Rio de Janeiro"],
            ["UF" => "RN", "nome" => "Rio Grande do Norte"],
            ["UF" => "RO", "nome" => "Rondônia"],
            ["UF" => "RS", "nome" => "Rio Grande do Sul"],
            ["UF" => "RR", "nome" => "Roraima"],
            ["UF" => "SC", "nome" => "Santa Catarina"],
            ["UF" => "SE", "nome" => "Sergipe"],
            ["UF" => "TO", "nome" => "Tocantins"]
        ];
        DB::table('estados')->insert($estados);
    }
}
