<?php

namespace Casa\Http\Controllers;

use Casa\Estado;
use Casa\Adotante;
use Casa\EstadoCivil;
use Illuminate\Http\Request;

class RelatorioAdotanteController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $opcoes['estados'] = Estado::all()->pluck('UF', 'id');
        $opcoes['estadosCivis'] = EstadoCivil::all()->pluck('nome', 'id');

        return view('relatorio_adotante.index', compact('estadosCivis', 'opcoes'));       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $adotantes = Adotante::orderBy('nome')->paginate(10);
        $opcoes['estados'] = Estado::all()->pluck('UF', 'id');
        $opcoes['estadosCivis'] = EstadoCivil::all()->pluck('nome', 'id');
        return view('relatorio_adotante.index', compact('adotantes', 'opcoes'));  
    }
}
