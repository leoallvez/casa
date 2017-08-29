<?php

use \Casa\Visita;
use \Casa\Agenda;
use \Casa\Vinculo;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AgendaTest extends TestCase
{

    use DatabaseTransactions;

    public function testCreateAgenda()
    {
        $atributos = [
            'dia'               => '2017-08-26',
            'hora_inicio'       => '12:00',
            'hora_fim'          => '14:00',
            'status'            => 'agendada',
            'opiniao_adotantes' => 'Lorem ipsum dolor sit amet 1',
            'opiniao_adotivos'  => 'Lorem ipsum dolor sit amet 2',
            'observacoes'       => 'Lorem ipsum dolor sit amet 3',
        ];

        $agenda = new Agenda($atributos);

        $agenda->save();

        $this->seeInDatabase('agendas', ['dia' => '2017-08-26']);
    }

    public function testAssociateManyVisitasWithOneAgenda()
    {
        $atributos = [
            'dia'               => '2017-08-26',
            'hora_inicio'       => '12:00',
            'hora_fim'          => '14:00',
            'status'            => 'agendada',
            'opiniao_adotantes' => 'Lorem ipsum dolor sit amet 1',
            'opiniao_adotivos'  => 'Lorem ipsum dolor sit amet 2',
            'observacoes'       => 'Lorem ipsum dolor sit amet 3',
        ];

        $agenda = new Agenda($atributos);

        $agenda->save();

        $visitas = [
            new Visita(['vinculo_id' => 3811]),
            new Visita(['vinculo_id' => 3812]),
            new Visita(['vinculo_id' => 3813]),
            new Visita(['vinculo_id' => 3814]),
            new Visita(['vinculo_id' => 3815]),
        ];

        foreach($visitas as $visita) {
            $visita->agenda()->associate($agenda)->save();
        }

        $this->seeInDatabase('visitas', ['vinculo_id' => 3811]);
        $this->seeInDatabase('visitas', ['vinculo_id' => 3812]);
        $this->seeInDatabase('visitas', ['vinculo_id' => 3813]);
        $this->seeInDatabase('visitas', ['vinculo_id' => 3814]);
        $this->seeInDatabase('visitas', ['vinculo_id' => 3815]);
    }

    public function testAssociateVisitaWithVinculo() 
    {
        $vinculo = new Vinculo(['adotante_id' => 3456, 'adotivo_id' => 9807]);
        $vinculo->save();

        $visita = new Visita(['agenda_id' => 7899]);

        $visita->vinculo()->associate($vinculo)->save();

        $this->seeInDatabase('visitas', ['agenda_id' => 7899]);
    }

    public function testAgendarVisita() 
    {
        $atributos = [
            'dia'               => '2017-09-05',
            'hora_inicio'       => '12:00',
            'hora_fim'          => '14:00',
            'status'            => 'agendada',
            'opiniao_adotantes' => 'Lorem ipsum dolor sit amet 1',
            'opiniao_adotivos'  => 'Lorem ipsum dolor sit amet 2',
            'observacoes'       => 'Lorem ipsum dolor sit amet 3',
        ];

        $agendar = new Agenda($atributos);
        $agendado = $agendar->agendarVisita(2);

        $this->assertTrue($agendado);
        $this->seeInDatabase('agendas', ['dia' => '2017-09-05']);
    }
}
