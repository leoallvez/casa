<?php

use Illuminate\Database\Seeder;

class AdotanteAdotivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vinculos = [
	        [
		        "observacoes" => null,
		        "adotante_id" => 11,
		        "adotivo_id" => 14
	        ],
		    [
		        "observacoes" => null,
		        "adotante_id" => 1,
		        "adotivo_id" => 5
	        ],
	        [
		        "observacoes" => null,
		        "adotante_id" => 21,
		        "adotivo_id" => 19
	        ],
	        [
		        "observacoes" => null,
		        "adotante_id" => 4,
		        "adotivo_id" => 35
	        ],
	        [
		        "observacoes" => null,
		        "adotante_id" => 30,
		        "adotivo_id" => 3
	        ],
	        [
		        "observacoes" => null,
		        "adotante_id" => 26,
		        "adotivo_id" => 12
	        ],
	        [
		        "observacoes" => null,
		        "adotante_id" => 26,
		        "adotivo_id" => 32
	        ],
	        [
		        "observacoes" => null,
		        "adotante_id" => 24,
		        "adotivo_id" => 31
	        ],
	        [
		        "observacoes" => null,
		        "adotante_id" => 27,
		        "adotivo_id" => 7
	        ],
	        [
		        "observacoes" => null,
		        "adotante_id" => 3,
		        "adotivo_id" => 40
	        ],
	        [
		        "observacoes" => null,
		        "adotante_id" => 19,
		        "adotivo_id" => 23
	        ],
	        [
		        "observacoes" => null,
		        "adotante_id" => 19,
		        "adotivo_id" => 11
	        ],
	        [
		        "observacoes" => null,
		        "adotante_id" => 28,
		        "adotivo_id" => 37
	        ],

        ];
        DB::table('adotantes_adotivos')->insert($vinculos);
    }
}
