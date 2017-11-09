<?php

namespace Casa\Http\Controllers;

use Casa\Agenda;
use Casa\Visita;
use Casa\Adotivo;
use Casa\Vinculo;
use Casa\Adotante;
use Casa\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Casa\Http\Requests\RegistraVisitaRequest;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {        
        $vinculo = new Vinculo();

        $adotantes = $vinculo->listarAdotantesComViculos();
        $adotivos  = $vinculo->listarAdotivosComVinculo();

        $instituicao = Instituicao::whereId(Auth::user()->instituicao_id)->first();

        return view('agenda.agendar', compact('adotantes', 'adotivos', 'instituicao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $agenda = new Agenda($request->all());

        $agendado = $agenda->agendarVisita($request->adotante_id);

        if($agendado) {
            return json_encode([
                'status'  => true,
                'message' => 'Visita agendada com sucesso',
            ]);
        }

        return json_encode([
            'status'  => false, 
            'message' => 'Adotante já possui visita agendada para esse dia',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
        $agenda = Agenda::find($id);

        $reagendado = $agenda->reagendarVisita($request->all());
        
        if($reagendado) {
            return json_encode([
                'status'  => true, 
                'message' => 'Visita reagendada com sucesso'
            ]);
        }

        return json_encode([
            'status'  => false, 
            'message' => 'Adotante já possui visita agendada para esse dia',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) 
    {
        $agenda = Agenda::find($id);
        $cancelado = $agenda->cancelarVisita($request->observacoes);

        if($cancelado) {
            return json_encode([
                'status'  => true, 
                'message' => 'Visita cancelada com sucesso',
            ]);
        }

        return json_encode([
            'status'  => false, 
            'message' => 'Visita cancelada não cancelada',
        ]);
    }

    public function listar() 
    {
        return response()->json(Agenda::listar());
    }    

    public function buscarAdotivos($adotante_id) 
    {
        if(!is_null($adotante_id)) {
            return json_encode([
                'status'   => true, 
                'adotivos' => (new Vinculo)->getAdotivosByAdotantesId($adotante_id),
            ]);
        }
        return  json_encode(['status'  => false]);
    }   

    public function registrarListar() 
    {
        $agendas = Agenda::whereStatus(Agenda::AGENDADA);
        $agendas = $agendas->where('dia','<', date('Y-m-d'))->orderBy('dia', 'desc')->get();

        $collection = collect();

        foreach($agendas as $agenda) {

            foreach($agenda->visitas as $visita) {
      
                if(!$visita->is_registada) {
                    $collection->prepend($visita);
                }
            }
        }

        $visitas = $collection;

        return view('agenda.registrar_list', compact('visitas')); 
    }

    public function registrarGet($id)
    {
        $visita = Visita::find($id);
        $agenda = $visita->agenda;
        
        return view('agenda.registrar', compact('visita','agenda'));   
    }

    public function registrarPost(RegistraVisitaRequest $request, $id)
    {
        Visita::find($id)->update($request->all());

        flash(
            "Visita Registrada com sucesso.",
            'success'
        );

        return redirect('visitas/registra/listar');

    }
}
