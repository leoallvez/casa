<?php

namespace Casa\Http\Controllers;

use Casa\Estado;
use Casa\Adotante;
use Casa\EstadoCivil;
use Illuminate\Http\Request;

class RelatorioAdotanteController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $opcoes['estados'] = Estado::all()->pluck('UF', 'id');
        $opcoes['estadosCivis'] = EstadoCivil::all()->pluck('nome', 'id');

        return view('relatorio_adotante.index', compact('estadosCivis', 'opcoes'));       
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
        $adotantes = Adotante::orderBy('nome')->paginate(10);
        $opcoes['estados'] = Estado::all()->pluck('UF', 'id');
        $opcoes['estadosCivis'] = EstadoCivil::all()->pluck('nome', 'id');
        return view('relatorio_adotante.index', compact('adotantes', 'opcoes'));  
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
