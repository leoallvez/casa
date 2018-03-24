<?php

namespace Casa\Http\Controllers;

use Casa\Etnia;
use Casa\Adotivo;
use Casa\Adotante;
use Casa\Restricao;
use Casa\AdotivoLog;
use Casa\Escolaridade;
use Casa\AdotivoStatus;
use Casa\Nacionalidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Casa\Http\Requests\AdotivoRequest;

class AdotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $adotivos = Adotivo::where('instituicao_id', Auth::user()->instituicao_id)
        ->orderBy('nome')
        ->paginate(config('app.list_size'));

        return view('adotivo.index', compact('adotivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        $matricula = Adotivo::gerarMatricula();

        $adotantes = Adotante::pluck('nome', 'id');
        $status    = AdotivoStatus::where('id', '<', AdotivoStatus::RECEBENDO_VISITA)->pluck('nome', 'id');
        $etnias    = Etnia::pluck('nome', 'id');
        $nascionalidades = Nacionalidade::pluck('nome', 'id');
        $restricoes = Restricao::pluck('nome', 'id');

        $irmaos = Adotivo::where('instituicao_id', Auth::user()->instituicao_id)
        ->orderBy('nome')
        ->pluck('nome', 'id');

        return view('adotivo.create', compact(
            'matricula',
            'adotantes',
            'status',
            'etnias',
            'nascionalidades',
            'restricoes',
            'irmaos'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdotivoRequest $request) 
    {
        $adotivo = new Adotivo($request->all());
        #Usuário logado no sistema.
        $usuario = Auth::user();

        $adotivo->setInstituicao($usuario->instituicao_id);
        $adotivo->setUsuario($usuario->id);

        $adotivo->save();

        $log = new AdotivoLog();
        $log->setAll($adotivo);
        $log->salvar();

        $adotivo->salvarIrmaos($request->irmaosIds);

        flash(
            "Adotivo ".$adotivo->nome." Incluído com Sucesso!",
            'success'
        );
        return redirect('adotivos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $adotivo = Adotivo::find($id);

        if (Gate::allows('has_access', $adotivo)) {

            $adotantes = Adotante::all()->pluck('nome', 'id');
            $status    = AdotivoStatus::pluck('nome', 'id');
            $etnias    = Etnia::pluck('nome', 'id');
            $nascionalidades = Nacionalidade::pluck('nome', 'id');

            $adotante   = $adotivo->adotantes()->first();
            $restricoes = Restricao::pluck('nome', 'id');

            $conditions = [
                            ['instituicao_id','=', Auth::user()->instituicao_id ], 
                            ['id','<>', $adotivo->id],
                        ];

            $irmaos = Adotivo::where($conditions)
            ->orderBy('nome')
            ->pluck('nome', 'id');

            $irmaosIds = $adotivo->getIrmaosIds();

            return view('adotivo.edit',
                compact(
                    'adotivo',
                    'adotantes',
                    'adotante',
                    'status',
                    'etnias',
                    'nascionalidades',
                    'restricoes',
                    'irmaos',
                    'irmaosIds'
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

    public function update(AdotivoRequest  $request, $id) 
    {
        $adotivo = Adotivo::find($id);

        if (Gate::allows('has_access', $adotivo)) {

            $adotivo->update($request->all());
        
            $log = new AdotivoLog();
            $log->setAll($adotivo);
            $log->altualizarOuSalvar();

            $adotivo->atualizarIrmaos($request->irmaosIds);
            flash(
                "Adotivo ".$adotivo->nome." Alterado com Sucesso!",
                "success"
            );

            return redirect('adotivos');
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
        $adotivo = Adotivo::find($id);

        if (Gate::allows('has_access', $adotivo)) {

            $adotivo->destroy($id);
            flash("Adotivo Inativado(a) com Sucesso", 'danger');
            return json_encode(['status' => true]);
        }
        return json_encode(['status' => false, 'message' => 'Acesso negado!']);
    }

    public function buscar(Request $request) 
    {
        # Retirar os espaços do inicios e fim da string.
        $inputBusca = trim($request->inputBusca);
        
        $adotivos = (new Adotivo())->buscar($inputBusca);

        return view('adotivo.index', compact('adotivos', 'inputBusca'));
    }
}
