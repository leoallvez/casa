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
use Casa\Http\Requests\AdotivoRequest;

class AdotivoController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $adotivos = Adotivo::where('instituicao_id', Auth::user()->instituicao_id)
        ->orderBy('nome')
        ->paginate(10);

        return view('adotivo.index', compact('adotivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $matricula = Adotivo::gerarMatricula();

        $adotantes = Adotante::pluck('nome', 'id');
        $status    = AdotivoStatus::where('id', '<', 3)->pluck('nome', 'id');
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
    public function store(AdotivoRequest $request) {

        $adotivo = new Adotivo($request->all());

        #Usuário logado no sistema.
        $usuario = Auth::user();

        $adotivo->setInstituicao($usuario->instituicao_id);
        $adotivo->setUsuario($usuario->id);

        $adotivo->save();

        (new AdotivoLog($adotivo))->save();

        $adotivo->salvarIrmaos($request->irmaosIds);

        flash(
            "Adotivo ".$adotivo->nome." Incluído com Sucesso!",
            'success'
        );
        return redirect('adotivos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $adotivo   = Adotivo::findOrFail($id);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(AdotivoRequest  $request, $id) {

        $adotivo = Adotivo::findOrFail($id);

        $adotivo->update($request->all());
        //TODO: se não hove mudança não criar log
        (new AdotivoLog($adotivo))->save();
       
        $adotivo->altualizarIrmaos($request->irmaosIds);
        flash(
            "Adotivo ".$adotivo->nome." Alterado com Sucesso!",
            "success"
        );

        return redirect('adotivos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Adotivo::destroy($id);

        flash("Adotivo Inativado(a) com Sucesso", 'danger');
        return json_encode(['status' => true]);
    }

    public function buscar(Request $request) {
        # Retirar os espaços do incios e fim da string.
        $request->inputBusca = trim($request->inputBusca);
        
        $adotivos = Adotivo::where('nome', 'like', '%'.$request->inputBusca.'%')
        ->where('instituicao_id', Auth::user()->instituicao_id)
        ->orderBy('nome')
        ->paginate(10);

        $inputBusca = $request->inputBusca;

        return view('adotivo.index', compact('adotivos', 'inputBusca'));
    }
}
