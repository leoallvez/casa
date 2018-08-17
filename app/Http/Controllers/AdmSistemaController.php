<?php

namespace Casa\Http\Controllers;

use Casa\User;
use Casa\AdmSistema;
use Casa\UsuarioNivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Casa\Http\Requests\UserStoreRequest;
use Casa\Http\Requests\UserUpdateRequest;

class AdmSistemaController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        if (Gate::allows('is_system_administrator')) {
            $adms = AdmSistema::listar(UsuarioNivel::ADM_SISTEMA);
            
            return view('adm-sistema.index', compact('adms'));
        }
        return redirect()->action('AcessoNegadoController@index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        if (Gate::allows('is_system_administrator')) {
            $niveis = UsuarioNivel::all()->pluck('nome', 'id');
            
            return view('adm-sistema.create', compact('niveis'));
        }
        return redirect()->action('AcessoNegadoController@index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request) 
    {
        $adm = new AdmSistema($request->except(['password']));
        $adm->save();

        flash('Administrador do Sistema Incluído com Sucesso', 'success');

        return redirect('administradores-sistema');
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

            $adm = AdmSistema::find($id);
            $niveis = UsuarioNivel::listar();
            
            return view('adm-sistema.edit', compact('adm','niveis'));
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
        if (Gate::allows('is_system_administrator')) {

            $adm = AdmSistema::find($id);
            $adm->setSenha($request->password);
            $adm->update($request->except(['password']));

            flash('Administrador do Sistema Alterado com Sucesso!', 'success');

            return redirect('administradores-sistema');
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
            $adm = AdmSistema::find($id);
            
            $adm->destroy($id);
            flash('Administrador do Sistema Inativado com Sucesso', 'danger');
            return json_encode(['status' => true]);
        }
        return json_encode(['status' => false, 'message' => 'Acesso negado!']);
    }
    
    public function buscar(Request $request) 
    {
        if (Gate::allows('is_system_administrator')) {
            $adms = AdmSistema::buscar($request->inputBusca, UsuarioNivel::ADM_SISTEMA);

            $inputBusca = $request->inputBusca;

            return view('adm-sistema.index', compact('adms', 'inputBusca'));
        }
        return redirect()->action('AcessoNegadoController@index');
    }
}
