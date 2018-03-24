<?php

namespace Casa\Http\Controllers;

use Casa\Estado;
use Casa\Adotivo;
use Casa\Adotante;
use Casa\EstadoCivil;
use Casa\Escolaridade;
use Casa\Nacionalidade;
use Illuminate\Http\Request;
use Casa\CategoriaProfissional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Casa\Http\Requests\AdotanteRequest;


class AdotanteController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $adotantes = Adotante::where('instituicao_id', Auth::user()->instituicao_id)
        ->orderBy('nome')
        ->paginate(config('app.list_size'));
        
        return view('adotante.index', compact('adotantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        $estadosCivis = EstadoCivil::pluck('nome', 'id');
        $estados = Estado::pluck('nome', 'id');
        $escolaridades = Escolaridade::pluck('nome', 'id');
        $categoriasProfissionais = CategoriaProfissional::pluck('nome', 'id');
        $nascionalidades = Nacionalidade::pluck('nome', 'id');

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
    public function store(AdotanteRequest $request) 
    {
        Adotante::validarConjuge($request);

        $adotante = new Adotante($request->all());

        #Usuário logado no sistema.
        $usuario = Auth::user();

        $adotante->setInstituicao($usuario->instituicao_id);
        $adotante->setUsuario($usuario->id);

        $adotante->save();

        flash("Adotante ".$adotante->nome." Incluído com Sucesso!", "success");
        return redirect('adotantes');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $adotante = Adotante::find($id);

        if (Gate::allows('has_access', $adotante)) {
            $estadosCivis = EstadoCivil::all()->pluck('nome', 'id');
            $estados = Estado::all()->pluck('nome', 'id');

            $escolaridades = Escolaridade::all()->pluck('nome', 'id');
            $categoriasProfissionais = CategoriaProfissional::all()->pluck('nome', 'id');
            $nascionalidades = Nacionalidade::pluck('nome', 'id');

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
        return redirect()->action('AcessoNegadoController@index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdotanteRequest $request, $id) 
    {
        $adotante = Adotante::find($id);

        if (Gate::allows('has_access', $adotante)) {

            Adotante::validarConjuge($request);
            $adotante->update($request->all());

            flash("Adotante ".$adotante->nome." Alterado com Sucesso!", "success");
            return redirect('adotantes');
        }
        return redirect()->action('AcessoNegadoController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adotante = Adotante::find($id);

        if (Gate::allows('has_access', $adotante)) {

            $adotante->destroy($id);
            flash("Adotante inativado(a) com Sucesso", 'danger');
            return json_encode(['status' => true]);
        }
        return json_encode(['status' => false, 'message' => 'Acesso negado!']);
    }

    public function buscar(Request $request) 
    {
        # Retirar os espaços do incios e fim da string.
        $adotantes = (new Adotante)->buscar(trim($request->inputBusca));

        return view('adotante.index', compact('adotantes', 'inputBusca'));
    }
}
