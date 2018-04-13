<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder 
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
    	$usuarios = [
            # Administrador
    		[
    			'name'           => 'Administrador',
    			'email'          => 'adm@casa.com.br',
                'password'       =>  Hash::make('senhacasa'),
                'cpf'            => '200.175.702-63',
                'cargo'          => 'Administrador',
                'nivel_id'       => 1,
                'created_at'     => "2017-09-05",
                'instituicao_id' => 1
    		],
            # Pessoal
            [
                'name'           => 'Camila Sampaio A. Fereira',
                'email'          => 'camila@casa.com.br',
                'password'       =>  Hash::make('senhacasa'),
                'cpf'            => '547.828.685-02',
                'cargo'          => 'Administradora',
                'nivel_id'       => 1,
                'created_at'     => "2017-09-05",
                'instituicao_id' => 1
            ],
            [
                'name'           => 'Eliane de Oliveira Mendes',
                'email'          => 'eliane@casa.com.br',
                'password'       =>  Hash::make('senhacasa'),
                'cpf'            => '268.827.421-03',
                'cargo'          => 'Administradora',
                'nivel_id'       => 1,
                'created_at'     => "2017-09-05",
                'instituicao_id' => 1
            ],
            [
                'name'           => 'Leonardo Pereira Alves',
                'email'          => 'leonardo@casa.com.br',
                'password'       =>  Hash::make('senhacasa'),
                'cpf'            => '664.813.168-39',
                'cargo'          => 'Desenvolvedor',
                'nivel_id'       => 1,
                'created_at'     => "2017-09-05",
                'instituicao_id' => 1
            ],
            [
                'name'           => 'Paloma Yanca Sandes',
                'email'          => 'paloma@casa.com.br',
                'password'       =>  Hash::make('senhacasa'),
                'cpf'            => '682.418.489-60',
                'cargo'          => 'Administradora',
                'nivel_id'       => 1,
                'created_at'     => "2017-09-05",
                'instituicao_id' => 1
            ],
            # Instituição Esperança.
            [
                'name'           => 'Luciano Amaral Filho',
                'email'          => 'adm@esperanca.com.br',
                'password'       =>  Hash::make('senhacasa'),
                'cpf'            => '798.293.595-81',
                'cargo'          => 'Administrador Instituição',
                'nivel_id'       => 2,
                'created_at'     => "2017-09-05",
                'instituicao_id' => 2
            ],
            [
                'name'           => 'Maria Lopes Silva',
                'email'          => 'padrao@esperanca.com.br',
                'password'       =>  Hash::make('senhacasa'),
                'cpf'            => '684.438.177-80',
                'cargo'          => 'Assistente',
                'nivel_id'       => 3,
                'created_at'     => "2017-09-05",
                'instituicao_id' => 2
            ],
            # Solicitações de cadastro.
            # Raio de Luz
            [
                'name'           => 'Ricardo de Lima Santana',
                'email'          => 'ricardo@luz.com.br',
                'password'       =>  Hash::make('senhacasa'),
                'cpf'            => '347.696.612-74',
                'cargo'          => 'Diretor',
                'nivel_id'       => 4,
                'created_at'     => "2017-09-05",
                'instituicao_id' => 3
            ],
            # Casa de Santa Clara
            [
                'name'           => 'Juliana da Silva',
                'email'          => 'juliana@santa-clara.com.br',
                'password'       =>  Hash::make('senhacasa'),
                'cpf'            => '262.456.184-60',
                'cargo'          => 'Gerente',
                'nivel_id'       => 4,
                'created_at'     => "2017-09-05",
                'instituicao_id' => 4
            ],
            # Centro Educacional à Criança e Adolescente.
            [
                'name'           => 'Katia Ferreira de Souza',
                'email'          => 'katia@centro-educacional.com.br',
                'password'       =>  Hash::make('senhacasa'),
                'cpf'            => '107.990.694-00',
                'cargo'          => 'Diretora',
                'nivel_id'       => 4,
                'created_at'     => "2017-09-05",
                'instituicao_id' => 5
            ]
    	];
        
    	DB::table('users')->insert($usuarios);
    }
}
