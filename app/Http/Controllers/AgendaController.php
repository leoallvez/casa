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
    public function index() {

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
        $agenda->agendarVisita($request->adotante_id);

        return json_encode([
           'status'  => true,
           'message' => 'Visita agendada com sucesso'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $agendaOriginal = Agenda::find($id);
        $agendaOriginal->update($request->all());
        $agendaOriginal->delete();

        // $request->status = "agendado";
        // $request->observacoes = null;

        $agendaNova = new Agenda($request->all());
        $agendaNova->agendarVisita($agendaOriginal->getAdotanteId());

        return json_encode([
            'status'  => true, 
            'message' => 'Visita reagendada com sucesso'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        
        $agenda = Agenda::find($id);
        $agenda->update($request->all());
        $agenda->delete();

        return json_encode([
            'status'  => true, 
            'message' => 'Visita cancelada com sucesso' 
        ]);
    }

    public function listar() {
        return Agenda::listar();
    }    

    public function buscarAdotivos($id) {

        if(!is_null($id)) {
            return json_encode([
                'status'   => true, 
                'adotivos' => (new Vinculo)->getAdotivosByAdotantesId($id),
            ]);
        }
        return  json_encode(['status'  => false]);
    }   
}
