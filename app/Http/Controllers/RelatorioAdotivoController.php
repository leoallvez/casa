<?php

namespace Casa\Http\Controllers;

use Casa\Etnia;
use Casa\Adotivo;
use Casa\AdotivoStatus;
use Illuminate\Http\Request;

class RelatorioAdotivoController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        $status = AdotivoStatus::all()->pluck('nome', 'id');
        $etnias = Etnia::all()->pluck('nome', 'id');
        $dadosStatus = Adotivo::getQuantidadePorStatus();
        $dimensaoValue = true;

        $adotivos = Adotivo::all();

        $idades[0] = "Menos de 1 ano";
        $idades[1] = "1 ano";
        for($i = 2; $i < 18; $i++) {
            $idades[$i] = $i." anos";    
        }
        $idades[] = "18 anos ou mais";

        return view('relatorio_adotivo.index', 
            compact('status','etnias', 'dadosStatus', 'dimensaoValue', 'adotivos', 'idades'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gerar(Request $request) 
    {
        // $adotivos = Adotivo::orderBy('nome')->paginate(10);
        $status = AdotivoStatus::all()->pluck('nome', 'id');
        $etnias = Etnia::all()->pluck('nome', 'id');
        $dadosStatus = Adotivo::getQuantidadePorStatus();
        if($request->dimensao_select == 1)
            $dimensaoValue = 1;
        else
            $dimensaoValue = 0;    

        return view('relatorio_adotivo.index', 
            compact('status','etnias', 'dadosStatus', 'dimensaoValue'));    
    }
}
