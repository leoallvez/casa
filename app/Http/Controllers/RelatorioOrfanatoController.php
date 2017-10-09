<?php

namespace Casa\Http\Controllers;

use Casa\Etnia;
use Casa\Estado;
use Casa\Adotivo;
use Casa\EstadoCivil;
use Casa\AdotivoStatus;
use Illuminate\Http\Request;

class RelatorioOrfanatoController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $opcoes['status'] = AdotivoStatus::all();
        $opcoes['etnias'] = Etnia::all();
        $opcoes['estados'] = Estado::all()->pluck('UF', 'id');
        $opcoes['estadosCivis'] = EstadoCivil::all()->pluck('nome', 'id');
        
        return view('relatorio_orfanato.index', compact('opcoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $opcoes['status'] = AdotivoStatus::all();
        $opcoes['etnias'] = Etnia::all();
        $opcoes['estados'] = Estado::all()->pluck('UF', 'id');
        $opcoes['estadosCivis'] = EstadoCivil::all()->pluck('nome', 'id');

        $orfanatos = [
            //'Esperança'
            // 'Luz do Sol',
            // 'Criança Feliz',
            // 'Docê Lar',
            'Lar do Afeto'
            // 'Vida Nova',
            // 'Felicidade',
            // 'Nosso Lar'
        ];
        return view('relatorio_orfanato.index', compact('opcoes','orfanatos'));
    }
}
