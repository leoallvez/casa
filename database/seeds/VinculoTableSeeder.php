<?php

use Illuminate\Database\Seeder;

class VinculoTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $vinculos = [
    		[
                'adotante_id'  => 1, 
                'adotivo_id'   => 27,
                'observacoes'  => 'A criança optou por cancelar as visitas.',
                'created_at'   => '2016-01-08',
                'deleted_at'   => '2016-02-02'
            ],
            [
                'adotante_id'  => 2, 
                'adotivo_id'   => 27,
                'observacoes'  => 'A criança optou por cancelar as visitas.',
                'created_at'   => '2016-03-12',
                'deleted_at'   => '2016-04-02'
            ],
            [
                'adotante_id'  => 3, 
                'adotivo_id'   => 27,
                'observacoes'  => 'A criança optou por cancelar as visitas.',
                'created_at'   => '2016-04-30',
                'deleted_at'   => '2016-05-14'
            ],
            [
                'adotante_id'  => 4, 
                'adotivo_id'   => 27,
                'observacoes'  => 'A criança optou por cancelar as visitas.',
                'created_at'   => '2016-05-20',
                'deleted_at'   => '2016-06-02'
            ],
            [
                'adotante_id'  => 5, 
                'adotivo_id'   => 27,
                'observacoes'  => 'A criança optou por cancelar as visitas.',
                'created_at'   => '2016-06-27',
                'deleted_at'   => '2016-10-02'
            ],
            [
                'adotante_id'  => 6, 
                'adotivo_id'   => 27,
                'observacoes'  => 'O adotante optou por cancelar as visitas.',
                'created_at'   => '2016-10-08',
                'deleted_at'   => '2016-11-09'
            ],
            [
                'adotante_id'  => 7, 
                'adotivo_id'   => 27,
                'observacoes'  => 'A criança optou por cancelar as visitas.',
                'created_at'   => '2017-01-08',
                'deleted_at'   => '2017-02-02'
            ],
            [
                'adotante_id'  => 8, 
                'adotivo_id'   => 27,
                'observacoes'  => 'A criança optou por cancelar as visitas.',
                'created_at'   => '2017-02-08',
                'deleted_at'   => '2017-03-02'
            ],
            [
                'adotante_id'  => 9, 
                'adotivo_id'   => 27,
                'observacoes'  => 'O adotivo optou por cancelar as visitas.',
                'created_at'   => '2017-03-08',
                'deleted_at'   => '2017-04-02'
            ],
            [
                'adotante_id'  => 10, 
                'adotivo_id'   => 27,
                'observacoes'  => 'O adotivo optou por cancelar as visitas.',
                'created_at'   => '2017-05-08',
                'deleted_at'   => '2017-06-09'
            ]
    	];
    	DB::table('adotantes_adotivos')->insert($vinculos);
    }
}
