<?php

namespace Casa\Http\Controllers;

use Casa\Adotivo;
use Casa\Vinculo;
use Casa\Adotante;
use Casa\AgendaVisita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaVisitaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        #Listar todos os ids dos adotantes que tem vinculo
        $adotantes_ids = Vinculo::where('deleted_at', null)->pluck('adotante_id');

        $adotantes = Adotante::whereIn('id', $adotantes_ids)
        ->where('instituicao_id', Auth::user()->instituicao_id)
        ->get();
        # TODO Verificar se foi encontrado adotantes.
        /** Nome de adotate com conjuge caso tenha. */

        if(!$adotantes->isEmpty()) {
            foreach ($adotantes as $adotante) {
                $adotante->nome = $adotante->getNomeEnomeConjuge(); 
            }
            $adotantes = $adotantes->pluck('nome', 'id');
        }

        // dd($adotantes);

        $adotivos_ids = Vinculo::where('deleted_at', null)->pluck('adotivo_id');
        #Listas dos adotivos do da instituição que tem vinculo
        $adotivos = Adotivo::whereIn('id', $adotivos_ids)
        ->where('instituicao_id', Auth::user()->instituicao_id)
        ->pluck('nome', 'id');

        return view('agenda-visita.agenda', compact('adotantes', 'adotivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $visita = new AgendaVisita($request->all());
        $visita->save();

        return json_encode([
           'status'  => true,
           'message' => 'Visita agendada com sucesso'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $visita = AgendaVisita::find($id);
        $visita->update($request->all());

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
    public function destroy($id) {

       AgendaVisita::destroy($id);

       return json_encode([
           'status'  => true, 
           'message' => 'Visita cancelada com sucesso' 
       ]);
    }

    public function listar() {

        # TODO: listar apenas a visita da instituição
        return AgendaVisita::all();
    }       
}
