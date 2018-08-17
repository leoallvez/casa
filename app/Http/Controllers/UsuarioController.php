<?php

namespace Casa\Http\Controllers;

use Casa\User;
use Casa\Usuario;
use Casa\UsuarioNivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Casa\Http\Requests\UserStoreRequest;
use Casa\Http\Requests\UserUpdateRequest;

class UsuarioController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $usuarios = Usuario::listar();

        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        $niveis = UsuarioNivel::all()->pluck('nome', 'id');

        return view('usuario.create', compact('niveis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request) 
    {
        $usuario = new Usuario($request->except(['password']));

        $usuario->save();

        flash('Usuário Incluído com Sucesso', 'success');

        return redirect('usuarios');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $usuario = Usuario::find($id);

        if (Gate::allows('has_access', $usuario)) {

            $niveis = UsuarioNivel::listar();

            return view('usuario.edit', compact('usuario','niveis'));
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
    public function update(UserUpdateRequest $request, $id) 
    {
        $usuario = Usuario::find($id);

        if (Gate::allows('has_access', $usuario)) {
            $usuario->setSenha($request->password);
            $usuario->update($request->except(['password']));

            flash('Informações Alteradas com Sucesso!', 'success');
            #Se for um usuário comum  ou for adm de instituição
            if (Auth::user()->id == $id) {
                return redirect('/');
            }

            return redirect('usuarios');
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
        
        $usuario = Usuario::find($id);
        
        if (Gate::allows('has_access', $usuario)) {

            $usuario->destroy();
            flash('Usuário Inativado com Sucesso', 'danger');
            return json_encode(['status' => true]);
        }
    
        return json_encode(['status' => false, 'message' => 'Acesso negado!']);
    }

    public function buscar(Request $request) 
    {
        $usuarios = Usuario::buscar($request->inputBusca);
       
        $inputBusca = $request->inputBusca;

        return view('usuario.index', compact('usuarios', 'inputBusca'));
    }

    public function findUsers($id) 
    {
        # Serão pesquisados apenas usuario padrões e adm instituição.
        $usuarios = [UsuarioNivel::ADM_INSTITUICAO , UsuarioNivel::PADRAO];

        $adm = Usuario::where('id', $id)->whereIn('nivel_id', $usuarios)->first();

        if (Gate::allows('has_access', $adm)) {

            return response()->json(['status' => true, 'adm' => $adm], 200);
        }
        
        return response()->json(['status' => false], 204);
    }
}