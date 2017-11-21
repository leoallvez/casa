<?php

namespace Casa\Http\Controllers;

use Casa\Etnia;
use Casa\Adotivo;
use Casa\AdotivoLog;
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
        //dd($objeto);
        # Valores para os drop down list.
        $status = AdotivoStatus::all()->pluck('nome', 'id');
        $etnias = Etnia::all()->pluck('nome', 'id');
        $adotivos = Adotivo::all(); //TODO: pegar do logs
        $idades = getIdadesHelper();

        # Valores para os gráficos
        $dadosStatus = quantidadePorStatusHelper($adotivos);
        $dadosSexo   = porcentagemAdotivoSexoHelper($adotivos);
        $dadosEtnias = quantidadePorEtniaHelper($adotivos);

        return view('relatorio_adotivo.index', 
            compact('status', 'etnias', 'adotivos', 'idades', 'dadosStatus', 'dadosSexo', 'dadosEtnias'));     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gerar(Request $request) 
    {
        # Valores para os drop down list.
        $status = AdotivoStatus::all()->pluck('nome', 'id');
        $etnias = Etnia::all()->pluck('nome', 'id');
        $idades = getIdadesHelper();

    
        #Busca nos logs de acordo com os filtros escolhidos.
        $resultados = AdotivoLog::pesquisar($request); 
        
        $adotivos = logsToAdotivosHelper($resultados);

        $dadosStatus = null;
        $dadosSexo   = null;
        $dadosEtnias = null;

        if(!$adotivos->isEmpty()) {
            # Valores para os gráficos
            $dadosStatus = (!isset($request->status)) ? quantidadePorStatusHelper($adotivos)    : null;
            $dadosSexo   = (!isset($request->sexo))   ? porcentagemAdotivoSexoHelper($adotivos) : null;
            $dadosEtnias = (!isset($request->etnia))  ? quantidadePorEtniaHelper($adotivos)     : null;
        }
  
        return view('relatorio_adotivo.index', 
            compact('status', 'etnias', 'adotivos', 'idades', 'dadosStatus', 'dadosSexo', 'dadosEtnias'));   
    }
}

 

