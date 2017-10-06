<?php

namespace Casa\Http\Controllers;

use Casa\Adotivo;
use Casa\Vinculo;
use Casa\Adotante;
use Casa\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $vinculo = new Vinculo();

        $adotantes =  $vinculo->listarAdotantesComViculos();
        $adotivos  =  $vinculo->listarAdotivosComVinculo();

        return view('agenda.index', compact('adotantes', 'adotivos'));
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
        $adotante_id = $request->adotante_id;

        $temVisitaNoDia = $agenda->adotanteTemVisitaNoDia($adotante_id);

        if(!$temVisitaNoDia) {
            $agenda->agendarVisita($adotante_id);

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
        $agendaOriginal = Agenda::find($id);

        $temVisitaNoDia = $agendaOriginal->adotanteTemVisitaNoDia(null, $request->dia);
        
        if(!$temVisitaNoDia) {

            $agendaOriginal->update($request->all());
            $agendaOriginal->delete();

            $agendaNova = new Agenda($request->all());
            $agendaNova->agendarVisita($agendaOriginal->getAdotanteId());

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
        $agenda->update($request->all());
        $agenda->delete();

        return json_encode([
            'status'  => true, 
            'message' => 'Visita cancelada com sucesso' 
        ]);
    }

    public function listar() 
    {
        return response()->json(Agenda::listar());
    }    

    public function buscarAdotivos($id) 
    {
        if(!is_null($id)) {
            return json_encode([
                'status'   => true, 
                'adotivos' => (new Vinculo)->getAdotivosByAdotantesId($id),
            ]);
        }
        return  json_encode(['status'  => false]);
    }   
}
