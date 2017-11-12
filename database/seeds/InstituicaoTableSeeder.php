<?php

use Illuminate\Database\Seeder;

class InstituicaoTableSeeder extends Seeder 
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        $instituicoes = [
        	[
                //id = 1 
        		'esta_aprovada'     => 1,
        		'razao_social'    => 'Casa Sistemas',
        		'cnpj'            => '73.332.363/0001-06',
        		'telefone'        => '(11) 3333-5555',
        		'endereco'        => 'Rua da Alegria',
                'endereco_numero' => '166',
        		'complemento'     => 'Próximo a estação de trêm',
        		'cep'             => '12345-125',
        		'bairro'          => 'Vila Renato',
        		'cidade'          => 'São Paulo',
        		'email'           => 'contato@casa.com.br',
        		'estado_id'       => 1,
                'created_at'      => "2017-09-05"
        	],
            [
                //id = 2
                'esta_aprovada'     => 1,
                'razao_social'    => 'Lar da Esperança',
                'cnpj'            => '31.218.703/0001-14',
                'telefone'        => '(11) 4444-5555',
                'endereco'        => 'Rua da Glória',
                'endereco_numero' => '123',
                'complemento'     => 'Próximo a estação de trêm',
                'cep'             => '12345-123',
                'bairro'          => 'Vila Renato',
                'cidade'          => 'São Paulo',
                'email'           => 'contato@esperanca.com.br',
                'estado_id'       => 1,
                'created_at'      => "2017-09-05"
            ],

            // Solicitação de Cadastro
            [
                //id = 3
                'esta_aprovada'     => 0,
                'razao_social'    => 'Raio de Luz',
                'cnpj'            => '67.511.217/0001-37',
                'telefone'        => '(22) 4444-5555',
                'endereco'        => 'Travessa Lauré',
                'endereco_numero' => '123',
                'complemento'     => '',
                'cep'             => '39402-827',
                'bairro'          => 'Pajuçara',
                'cidade'          => 'Natal',
                'email'           => 'contato@luz.com.br',
                'estado_id'       => 21,
                'created_at'      => "2017-09-05"
            ],
            [
                //id = 4
                'esta_aprovada'     => 0,
                'razao_social'    => 'Casa de Santa Clara',
                'cnpj'            => '27.124.548/0001-08',
                'telefone'        => '(11) 5444-1234',
                'endereco'        => 'Rua João Mateus de Moraes',
                'endereco_numero' => '4A',
                'complemento'     =>  '',
                'cep'             => '14702-114',
                'bairro'          => 'Jardim São Francisco',
                'cidade'          => 'Bebedouro',
                'email'           => 'contato@santa-clara.com.br',
                'estado_id'       => 1,
                'created_at'      => "2017-09-05"
            ],
            [
                //id = 5
                'esta_aprovada'     => 0,
                'razao_social'    => 'Centro Educacional à Criança e Adolescente',
                'cnpj'            => '55.826.461/0001-00',
                'telefone'        => '(11) 4781-0842',
                'endereco'        => 'Rua Santa Rita do Passa Quatro',
                'endereco_numero' => '1300',
                'complemento'     => 'Rua sem saída',
                'cep'             => '15805-045',
                'bairro'          => 'Jardim do Bosque',
                'cidade'          => 'Catanduva',
                'email'           => 'contato@centro-educacional.com.br',
                'estado_id'       => 1,
                'created_at'      => "2017-09-05"
            ]
        ];
        DB::table('instituicoes')->insert($instituicoes);
    }
}
