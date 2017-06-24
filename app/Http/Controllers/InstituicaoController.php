<?php

namespace Casa\Http\Controllers;
use Casa\User;
use Casa\Estado;
use Casa\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Casa\Http\Requests\InstituicaoRequest;

class InstituicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $instituicoes = Instituicao::where('is_aprovada', true)->paginate(10);

        return view('instituicao.index', compact('instituicoes'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instituicao = Instituicao::findOrfail($id);
        
        $usuario = User::where('instituicao_id', '=', $instituicao->id)->first();
        $estados = Estado::all()->pluck('UF', 'id');
        $disabled = true;

        return view('instituicao.show', compact('instituicao', 'usuario', 'estados', 'disabled'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $instituicao = Instituicao::findOrfail($id);
        
        $usuario = User::where('instituicao_id', '=', $instituicao->id)->first();
        $estados = Estado::all()->pluck('nome', 'id');
        $disabled = false;

        return view('instituicao.edit', compact('instituicao', 'usuario', 'estados', 'disabled'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstituicaoRequest $request, $id) {

        dd($request->all());
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

    public function buscar(Request $request) {
        # Retirar os espaços do incios e fim da string.
        $request->inputBusca = trim($request->inputBusca);

        $instituicoes = Instituicao::where('razao_social', 'like', '%'.$request->inputBusca.'%')
        ->orWhere('cnpj','=', setMascara($request->inputBusca, '##.###.###/####-##'))
        ->orderBy('razao_social')
        ->paginate(10);

        $inputBusca = $request->inputBusca;

        # ##.###.###/####-##

        return view('instituicao.index', compact('instituicoes', 'inputBusca'));
    }
}
