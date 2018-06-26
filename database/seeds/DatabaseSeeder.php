<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder 
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        $this->call(AdotantesTableSeeder::class);
        $this->call(AdotivosStatusTableSeeder::class);
        $this->call(AdotivosTableSeeder::class);
        $this->call(CategoriasProfissionaisTableSeeder::class);
        $this->call(EscolaridadesTableSeeder::class);
        $this->call(EstadosCivisTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(EtniasTableSeeder::class);
        $this->call(InstituicaoTableSeeder::class);
        $this->call(NacionalidadesTableSeeder::class);
        $this->call(RestricoesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UsuarioNiveisTableSeeder::class);
        $this->call(VinculoTableSeeder::class);
        $this->call(AdotanteAdotivoTableSeeder::class);
        #$this->call(AdotivoLogSeeder::class);
    }
}
