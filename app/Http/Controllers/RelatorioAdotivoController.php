<?php

namespace Casa\Http\Controllers;

use Casa\Etnia;
use Casa\Adotivo;
use Casa\AdotivoLog;
use Casa\AdotivoStatus;
use Illuminate\Http\Request;
use Casa\Http\Requests\RelatorioAdotivoRequest;

class RelatorioAdotivoController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $buscaRealizada = false;
        # Valores para os drop down list.
        $status = AdotivoStatus::all()->pluck('nome', 'id');
        $etnias = Etnia::all()->pluck('nome', 'id');
        $adotivos = collect([]);

        $status = collect(['' => "Todos Status"] + $status->all());
        $etnias = collect(['' => "Todas Etnias"] + $etnias->all());

        $idades = getIdadesHelper();

        # Valores para os gráficos
        $dadosStatus = null;
        $dadosSexo   = null;
        $dadosEtnias = null;

        return view('relatorio_adotivo.index', 
            compact('status', 'etnias', 'adotivos', 'idades', 
                    'dadosStatus', 'dadosSexo', 'dadosEtnias', 'buscaRealizada'));     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gerar(RelatorioAdotivoRequest $request) 
    {
        $buscaRealizada = true;
        # Valores para os drop down list.
        $status = AdotivoStatus::all()->pluck('nome', 'id');
        $etnias = Etnia::all()->pluck('nome', 'id');
        $idades = getIdadesHelper();

        $status = collect(['' => "Todos Status"] +  $status->all());
        $etnias = collect(['' => "Todas Etnias"] +  $etnias->all());
    
        #Busca nos logs de acordo com os filtros escolhidos.
        $resultados = AdotivoLog::pesquisar($request->all()); 
        
        $adotivos = logsToAdotivosHelper($resultados);

        $dadosStatus = null;
        $dadosSexo   = null;
        $dadosEtnias = null;

        if(!$adotivos->isEmpty()) {
            # Valores para os gráficos
            $dadosStatus = (empty($request['status'])) ? json_encode(quantidadePorStatusHelper($adotivos))    : null;
            $dadosSexo   = (empty($request['sexo']))   ? json_encode(porcentagemAdotivoSexoHelper($adotivos)) : null;
            $dadosEtnias = (empty($request['etnia']))  ? json_encode(quantidadePorEtniaHelper($adotivos))     : null;
        }
  
        return view('relatorio_adotivo.index', 
            compact('status', 'etnias', 'adotivos', 'idades', 
                    'dadosStatus', 'dadosSexo', 'dadosEtnias', 'buscaRealizada'));   
    }
}

 

