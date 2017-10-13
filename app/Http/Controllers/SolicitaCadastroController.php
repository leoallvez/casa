<?php

namespace Casa\Http\Controllers;

use Casa\User;
use Casa\Estado;
use Casa\Usuario;
use Casa\Instituicao;
use Casa\UsuarioNivel;
use Casa\SolicitaCadastro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Casa\Http\Requests\SolicitarCadastroRequest;
use Casa\Http\Requests\SolicitarCadastroReprovarRequest;

class SolicitaCadastroController extends Controller 
{
    /**     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $solicitacoes = Instituicao::where('is_aprovada', false)->paginate(10);

        return view('solicitacao.index', compact('solicitacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        $estados = Estado::all()->pluck('nome', 'id');

        return view('solicitacao.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolicitarCadastroRequest $request) 
    {
        # Instituição.
        $instituicao = new Instituicao($request->all());
        $instituicao->setIsAprovada(false);
        $instituicao->setEmail($request->email_instituicao);
        $instituicao->save();
        # Usuário.
        $usuario = new Usuario($request->except(['password']));
        $usuario->setInstituicao($instituicao->id);
        $usuario->setEmail($request->email_adminstrador);
        $usuario->setSenha($request->password);
        $usuario->setNivel(UsuarioNivel::CANDIDATO);
        $usuario->save();

        flash('Solicitação enviada com sucesso e será analisada pelo administrador do sistema!', 'success');

        return redirect('login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function analisar($id) 
    {
        $instituicao = Instituicao::findOrfail($id);
        
        $usuario = User::where('instituicao_id', '=', $instituicao->id)->first();
        $estados = Estado::all()->pluck('UF', 'id');

        return view('solicitacao.analisar', compact('instituicao', 'usuario', 'estados'));
    }

    public function aprovar($id) 
    {
        # Instituição.
        $instituicao = Instituicao::findOrfail($id);
        $instituicao->setIsAprovada(true);
        $instituicao->save();
        # Usuário.
        $usuario = Usuario::where('instituicao_id', '=', $id)->first();
        $usuario->setNivel(UsuarioNivel::ADM_INSTITUICAO);
        $usuario->save();

        flash('Instituição '.$instituicao->razao_social.' aprovada com sucesso!', 'success');
        return redirect('solicitar-cadastro');
    }

    public function reprovar(SolicitarCadastroReprovarRequest $request, $id) 
    {
        $instituicao = Instituicao::findOrfail($id);  
        $usuario = Usuario::where('instituicao_id', '=', $id)->first();
        flash('Instituição '.$instituicao->razao_social.' reprovada com sucesso!', 'success');
        # Enviar E-mail. $request->motivo_reprovacao.
        $instituicao->delete();
        # Excluíndo fisicamente usuário da base de dados. 
        $usuario->forceDelete(); 

        return redirect('solicitar-cadastro');
    }

    public function buscar(Request $request) 
    {
        $solicitacoes = Instituicao::where('is_aprovada', '=', 'false')
        ->where('razao_social', 'like', '%'.$request->inputBusca.'%')
        ->orWhere('cnpj','=', setMascara($request->inputBusca, '##.###.###/####-##'))
        ->orderBy('razao_social')
        ->paginate(10);

        return view('solicitacao.index', compact('solicitacoes'));
    }
}
