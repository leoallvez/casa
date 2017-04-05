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
            ["UF" => "SP"],
            ["UF" => "AC"],
            ["UF" => "AL"],
            ["UF" => "AM"],
            ["UF" => "AP"],
            ["UF" => "BA"],
            ["UF" => "CE"],
            ["UF" => "DF"],
            ["UF" => "ES"],
            ["UF" => "GO"],
            ["UF" => "MA"],
            ["UF" => "MT"],
            ["UF" => "MS"],
            ["UF" => "MG"],
            ["UF" => "PA"],
            ["UF" => "PB"],
            ["UF" => "PR"],
            ["UF" => "PE"],
            ["UF" => "PI"],
            ["UF" => "RJ"],
            ["UF" => "RN"],
            ["UF" => "RO"],
            ["UF" => "RS"],
            ["UF" => "RR"],
            ["UF" => "SC"],
            ["UF" => "SE"],
            ["UF" => "TO"]
        ];
        DB::table('estados')->insert($estados);
    }
}
