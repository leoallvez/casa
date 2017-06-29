<?php

namespace Casa\Http\Controllers;

use Casa\Etnia;
use Casa\Adotivo;
use Casa\AdotivoStatus;
use Illuminate\Http\Request;

class RelatorioAdotivoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $status = AdotivoStatus::all()->pluck('nome', 'id');
        $etnias = Etnia::all()->pluck('nome', 'id');
        $dadosStatus = Adotivo::getQuantidadePorStatus();
        $dimensaoValue = true;

        return view('relatorio_adotivo.teste_graficos', compact('status','etnias', 'dadosStatus', 'dimensaoValue'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gerar(Request $request) {
        // $adotivos = Adotivo::orderBy('nome')->paginate(10);
        $status = AdotivoStatus::all()->pluck('nome', 'id');
        $etnias = Etnia::all()->pluck('nome', 'id');
        $dadosStatus = Adotivo::getQuantidadePorStatus();
        if($request->dimensao_select == 1)
            $dimensaoValue = 1;
        else
            $dimensaoValue = 0;    


        return view('relatorio_adotivo.teste_graficos', compact('status','etnias', 'dadosStatus', 'dimensaoValue'));    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

    }
}
