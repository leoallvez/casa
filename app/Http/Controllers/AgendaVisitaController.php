<?php

namespace Casa\Http\Controllers;

use Casa\AgendaVisita;
use Illuminate\Http\Request;

class AgendaVisitaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('agenda-visita.agenda');
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
        return AgendaVisita::all();
    }       
}
