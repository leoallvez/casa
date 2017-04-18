<?php

namespace Casa\Http\Controllers;

use Casa\Estado;
use Casa\Adotivo;
use Casa\Adotante;
use Casa\EstadoCivil;
use Casa\Escolaridade;
use Casa\Nascionalidade;
use Illuminate\Http\Request;
use Casa\CategoriaProfissional;
use Illuminate\Support\Facades\Auth;
use Casa\Http\Requests\VinculoRequest;
use Casa\Http\Requests\AdotanteRequest;


class AdotanteController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $adotantes = Adotante::where('instituicao_id', Auth::user()->instituicao_id)
        ->orderBy('nome')
        ->paginate(10);
        return view('adotante.index', compact('adotantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $estadosCivis = EstadoCivil::pluck('nome', 'id');
        $estados = Estado::pluck('UF', 'id');
        $escolaridades = Escolaridade::pluck('nome', 'id');
        $categoriasProfissionais = CategoriaProfissional::pluck('nome', 'id');
        // $adotivos = Adotivo::where('status_id', '=', 2)->pluck('nome', 'id');
        $nascionalidades = Nascionalidade::pluck('nome', 'id');

        return view('adotante.create', compact(
            'estadosCivis', 
            'estados', 
            'escolaridades',
            'categoriasProfissionais',
            'nascionalidades'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdotanteRequest $request) {

        Adotante::validarConjuge($request);

        $adotante = new Adotante($request->all());

        #Usuário logado no sistema.
        $usuario = Auth::user();

        $adotante->setInstituicao($usuario->instituicao_id);
        $adotante->setUsuario($usuario->id);
    
        $adotante->save();

        // $adotivos = $request->adotivos;
        # Salvando adotivos na tabela intermediaria adotante_adotivo.
        // if(isset($adotivos)){

        //     foreach($adotivos as $adotivo) {
        //         $adotivo = Adotivo::find($adotivo);
        //         $adotivo->setStatus(3);
        //         $adotante->adotivos()->save($adotivo);
        //     }
        // }

        flash("Adotante ".$adotante->nome." Incluído com Sucesso!", "success");
        return redirect('adotantes'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $adotante = Adotante::findOrFail($id);
        $estadosCivis = EstadoCivil::all()->pluck('nome', 'id');
        $estados = Estado::all()->pluck('UF', 'id');
        // $adotivosProcessoIds = $adotante->adotivos()->pluck('adotivo_id')->toArray();

        $escolaridades = Escolaridade::all()->pluck('nome', 'id');
        $categoriasProfissionais = CategoriaProfissional::all()->pluck('nome', 'id');
        $nascionalidades = Nascionalidade::pluck('nome', 'id');
        
        // if(empty($adotivosProcessoIds)){
        //     $adotivos = Adotivo::where('status_id', '=', 2)->pluck('nome', 'id');
        // }else{
        //     $adotivos = $adotante->adotivos()->get()->pluck('nome', 'id'); 
        // }

        return view('adotante.edit', 
            compact(
                'adotante', 
                'estadosCivis', 
                'estados', 
                'adotivos',
                'adotivosProcessoIds',
                'escolaridades',
                'categoriasProfissionais',
                'nascionalidades'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdotanteRequest $request, $id) {
        
        $adotante = Adotante::findOrFail($id);
        
        Adotante::validarConjuge($request);
        $adotante->update($request->all());

        $adotivos = $request->adotivos;
        
        /** Mudando status do adotivos selecionados.*/
        // if(isset($adotivos)){
        //     foreach($adotivos as $adotivo) {
        //         $adotivo = Adotivo::find($adotivo);

        //         $adotivo->setStatus(3);
        //         $adotante->adotivos()->save($adotivo);
        //     }
        //     /**Sync = 'Sincronizar' adotivos na tabela intermediaria.*/
        //     $adotante->adotivos()->sync($adotivos ?? []);
        // }
        flash("Adotante ".$adotante->nome." Alterado com Sucesso!", "success");
        return redirect('adotantes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        Adotante::findOrFail($id)->delete();

        flash("Adotante inativado(a) com Sucesso", 'danger');
        return json_encode(['status' => true]);
    }

    public function buscar(Request $request) {
        
        $adotantes = Adotante::where('nome', 'like', '%'.$request->inputBusca.'%')
        ->where('adotantes.instituicao_id', Auth::user()->instituicao_id)
        ->orWhere('cpf','=', setMascara($request->inputBusca, '###.###.###-##'))
        ->orderBy('nome')
        ->paginate(10);

        return view('adotante.index', compact('adotantes'));
    }
}

