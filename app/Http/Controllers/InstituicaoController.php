<?php

namespace Casa\Http\Controllers;

use Casa\User;
use Casa\Estado;
use Casa\Usuario;
use Casa\UsuarioNivel;
use Casa\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Casa\Http\Requests\InstituicaoRequest;

class InstituicaoController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        if (Gate::allows('is_system_administrator')) {
            $instituicoes = Instituicao::where('esta_aprovada', true)
            ->where('id', '<>', 1)
            ->orderBy('razao_social')
            ->paginate(config('app.list_size'));

            return view('instituicao.index', compact('instituicoes'));
        }
        return redirect()->action('AcessoNegadoController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        if (Gate::allows('is_system_administrator')) {
            $instituicao = Instituicao::findOrfail($id);
            
            $adm = User::where('instituicao_id', '=', $instituicao->id)
            ->whereIn('nivel_id', [UsuarioNivel::ADM_SISTEMA, UsuarioNivel::ADM_INSTITUICAO])->first();

            $estados = Estado::all()->pluck('UF', 'id');
            $disabled = true;

            return view('instituicao.edit', compact('instituicao', 'adm', 'estados', 'disabled'));
        }
        return redirect()->action('AcessoNegadoController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        if (Gate::allows('is_system_administrator')) {
            $instituicao = Instituicao::findOrfail($id);
            
            $adm = User::where('instituicao_id', '=', $instituicao->id)
            ->whereIn('nivel_id', [UsuarioNivel::ADM_SISTEMA, UsuarioNivel::ADM_INSTITUICAO])
            ->orderBy('name')
            ->first();

            $usuarios = User::where('instituicao_id', '=', $instituicao->id)
            ->where('deleted_at', null)
            ->pluck('name', 'id');

            $estados = Estado::all()->pluck('nome', 'id');
            $disabled = false;

            return view('instituicao.edit', compact('instituicao', 'adm', 'usuarios', 'estados', 'disabled'));
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
    public function update(InstituicaoRequest $request, $id) 
    {
        if (Gate::allows('is_system_administrator')) {
            $instituicao = Instituicao::findOrfail($id);

            $instituicao->atualizarAdm($request->all());

            flash('Instituicao Alterada com Sucesso!', 'success');
            
            return redirect('instituicao');
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
        if (Gate::allows('is_system_administrator')) {
            Instituicao::findOrFail($id)->delete();

            Usuario::where('instituicao_id', $id)->delete();

            flash("Instituição inativada com Sucesso", 'danger');
            return json_encode(['status' => true]);
        }
        return json_encode(['status' => false, 'message' => 'Acesso negado!']);
    }

    public function buscar(Request $request) 
    {
        if (Gate::allows('is_system_administrator')) {
            # Retirar os espaços do incios e fim da string.
            $request->inputBusca = trim($request->inputBusca);

            $instituicoes = Instituicao::where('esta_aprovada', true)
            ->where('id', '<>', 1);

            if (!empty($request->inputBusca)) {
                $instituicoes = $instituicoes->where('razao_social', 'like', '%'.$request->inputBusca.'%')
                ->orWhere('cnpj','=', setMascara($request->inputBusca, '##.###.###/####-##'));
            } 

            $instituicoes = $instituicoes->orderBy('razao_social')->paginate(config('app.list_size'));

            $inputBusca = $request->inputBusca;

            return view('instituicao.index', compact('instituicoes', 'inputBusca'));
        }
        return json_encode(['status' => false, 'message' => 'Acesso negado!']);
    }
}
