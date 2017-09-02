
<?php

use \Casa\Adotivo;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdotivoTest extends TestCase
{
    use DatabaseTransactions;

    public function  __construct() {

        $atributos = [
            'matricula'         => 'CASA-00001001',
            'nome'              => 'Frances Farmer',
            'sexo'              => 'F',
            'nascimento'        => '2008-10-10',
            'data_chegada'      => '2008-12-12',
            'data_adocao'       => null,
            'nacionalidade_id' =>  1,
            'instituicao_id'    => 2,
            'usuario_id'        => 4,
            'etnia_id'          => 1,
            'status_id'         => 1,
            'created_at'        => date('Y-m-d'),
        ];
    }


    public function testGetNomeAbreviadoByVinculoIdMethod()
    {
        $adotivo_nome = Adotivo::getNomeAbreviadoByVinculoId(1);
        $this->assertEquals("ALICE B.",$adotivo_nome);
    }
}

