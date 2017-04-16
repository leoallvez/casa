<?php

namespace Casa\Http\Controllers;

use Casa\User;
use Casa\Usuario;
use Casa\UsuarioNivel;
use Illuminate\Http\Request;
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
    public function index() {
        $usuarios = Usuario::listUsers();

        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $niveis = UsuarioNivel::all()->pluck('nome', 'id');

        $nivelCadastroId = Auth::user()->getNivelCadastro();

        return view('usuario.create', compact('niveis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request) {
        
        #Usuário logado no sistema.
        $usuarioLogado = Auth::user();
        
        $usuario = new Usuario($request->except(['password']));
        $usuario->setInstituicao($usuarioLogado->instituicao_id);
        $usuario->setNivel(3);
        $usuario->setSenha('casa'.date('Y'));
        $usuario->save();

        flash('Usuário Incluido com Sucesso', 'success');

        return redirect('usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $usuario = Usuario::findOrfail($id);

        $niveis = UsuarioNivel::all()->pluck('nome', 'id');
        # Retirando usuario candidato.
        unset($niveis[4]);

        return view('usuario.edit', compact('usuario','niveis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id) {

        $usuario = Usuario::findOrfail($id);
        $usuario->setSenha($request->password);
        $usuario->update($request->except(['password']));

        flash('Usuário Alterado com Sucesso!', 'success');

        /** Se for um usuário comum */
        if(!Auth::user()->isAdm()) {
            return redirect('/');
        }

        return redirect('usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $usuario = Usuario::findOrfail($id);
        $usuario->delete();

        flash('Usuário Inativado com Sucesso', 'danger');

        return $usuario; 
    }

    public function buscar(Request $request) {
  
        $usuarios = Usuario::where('nivel_id','!=', 4)
        ->where('name', 'like', '%'.$request->inputBusca.'%')
        ->orWhere('cpf','=', setMascara($request->inputBusca, '###.###.###-##'))
        ->orderBy('name')
        ->paginate(10);

        return view('usuario.index', compact('usuarios'));
    }
}
