<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	$usuarios = [
            # Administrador
    		[
    			'name'       => 'Administrador',
    			'email'      => 'administrador@casa.com.br',
                'password'   =>  Hash::make('casa2017'),
                'cpf'        => '200.175.702-63',
                'cargo'      => 'Administrador',
                'nivel_id'   => 1,
                'created_at' => date('Y-m-d'),
                'instituicao_id' => 1
    		],
            # Pessoal
            [
                'name'       => 'Camila Sampaio A. Fereira',
                'email'      => 'camila@casa.com.br',
                'password'   =>  Hash::make('casa2017'),
                'cpf'        => '547.828.685-02',
                'cargo'      => 'Administradora',
                'nivel_id'   => 1,
                'created_at' => date('Y-m-d'),
                'instituicao_id' => 1
            ],
            [
                'name'       => 'Eliane de Oliveira Mendes',
                'email'      => 'eliane@casa.com.br',
                'password'   =>  Hash::make('casa2017'),
                'cpf'        => '268.827.421-03',
                'cargo'      => 'Administradora',
                'nivel_id'   => 1,
                'created_at' => date('Y-m-d'),
                'instituicao_id' => 1
            ],
            [
                'name'       => 'Leonardo Pereira Alves',
                'email'      => 'leonardo@casa.com.br',
                'password'   =>  Hash::make('casa2017'),
                'cpf'        => '664.813.168-39',
                'cargo'      => 'Desenvolvedor',
                'nivel_id'   => 1,
                'created_at' => date('Y-m-d'),
                'instituicao_id' => 1
            ],
            [
                'name'       => 'Paloma Yanca Sandes',
                'email'      => 'paloma@casa.com.br',
                'password'   =>  Hash::make('casa2017'),
                'cpf'        => '682.418.489-60',
                'cargo'      => 'Administradora',
                'nivel_id'   => 1,
                'created_at' => date('Y-m-d'),
                'instituicao_id' => 1
            ]
    	];
    	DB::table('users')->insert($usuarios);
    }
}
