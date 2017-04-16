<?php

use Illuminate\Database\Seeder;

class InstituicaoTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $instituicoes = [
        	[
        		'is_aprovada'     => 1,
        		'razao_social'    => 'Casa Sistemas',
        		'cnpj'            => '73.332.363/0001-06',
        		'telefone'        => '(11) 3333-5555',
        		'endereco'        => 'Rua da Alegria',
                'endereco_numero' => '166',
        		'complemento'     => 'Próximo a estação de trêm',
        		'cep'             => '12345-123',
        		'bairro'          => 'Vila Renato',
        		'cidade'          => 'São Paulo',
        		'email'           => 'contato@casa.com.br',
        		'estado_id'       => 1
        	],
            [
                'is_aprovada'     => 1,
                'razao_social'    => 'Lar da Esperança',
                'cnpj'            => '31.218.703/0001-14',
                'telefone'        => '(11) 4444-5555',
                'endereco'        => 'Rua da Glória',
                'endereco_numero' => '123',
                'complemento'     => 'Próximo a estação de trêm',
                'cep'             => '12345-123',
                'bairro'          => 'Vila Renato',
                'cidade'          => 'São Paulo',
                'email'           => 'contato@esperança.com.br',
                'estado_id'       => 1
            ]
        ];
        DB::table('instituicoes')->insert($instituicoes);
    }
}
