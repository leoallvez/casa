<?php

namespace Casa\Http\Controllers;

use Casa\Vinculo;
use Casa\Adotivo;
use Casa\Adotante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Casa\Http\Requests\VinculoRequest;

class VinculoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) {

        $adotivo = Adotivo::find($id);
        
        if (Gate::allows('has_access',  $adotivo)) {
            /** [description] Listagem do histórico adotantes*/
            $adotantesHistorico = $adotivo->adotantes()
                ->orderBy('adotantes_adotivos.created_at')
                ->where('adotantes_adotivos.adotivo_id', '=', $id)
                ->where('adotantes_adotivos.deleted_at', '!=', null);
            /** 
             * Caso o adotivo tenha vínculo trazer o id do adotivo, 
             * senão null. 
            */
            $idAdotanteVinculo = $adotivo->adotantes()
                ->where('adotantes.tem_vinculo','=', 1)
                ->where('adotantes_adotivos.adotivo_id','=', $id)
                ->where('adotantes_adotivos.deleted_at','=', null)
                ->first()['id'];


            $adotantes = Adotante::orderBy('nome')
                ->where('adotantes.instituicao_id', Auth::user()->instituicao_id)
                ->get();
            /**
             * Tirar da listagem de adotantes disponiveis os adotantes
             * que já tiverram vínculo com o adotivo.
             */
            
            $adotantes = $adotantes->diff($adotantesHistorico->get());

            $adotantesHistorico = $adotantesHistorico->paginate(config('app.list_size')); 
            /** Nome de adotate com conjuge caso tenha. */
            foreach ($adotantes as $adotante) {
                $adotante->nome = $adotante->getNomeEnomeConjuge(); 
            }
            
            $vinculoAtual = Vinculo::where("adotivo_id", $adotivo->id)
            ->where("adotante_id", $idAdotanteVinculo)->first();

            $visitas = null;
            if (!is_null($vinculoAtual)) {
                    
                $visitas = $vinculoAtual->visitas()
                    ->where("is_registada", true)
                    ->get();
            }

            $adotantes = $adotantes->pluck('nome', 'id');
    
            return view('vinculo.index', compact(
                'adotivo', 
                'adotantesHistorico', 
                'adotantes', 
                'idAdotanteVinculo',
                'visitas'
            ));  
        } 

        return redirect()->action('AcessoNegadoController@index');
    }

    public function visualizar($adotivo_id, $adotante_id) 
    {
        $adotivo = Adotivo::find($adotivo_id);
        $adotante = $adotivo->adotantes()
        ->where('adotantes_adotivos.adotante_id', '=', $adotante_id)
        ->first();

        if (Gate::allows('has_access',  $adotivo)) {

            $vinculo = Vinculo::where("adotivo_id", $adotivo_id)->where("adotante_id", $adotante_id)->first();

            $visitas = $vinculo->visitas;
            
            return view('vinculo.visualizar', compact('adotivo', 'adotante', 'visitas')); 	
        }
        return redirect()->action('AcessoNegadoController@index');
    }

    public function vincular(VinculoRequest $request) 
    {
        $adotivo = Adotivo::find($request->adotivo_id);
        if (Gate::allows('has_access',  $adotivo)) {
            $adotante = Adotante::find($request->adotante_id);
            # Não podem tem menos 16 anos de diferença.
            if (!$adotivo->tem16AnosDeDiferenca($adotante)) {
                
                flash("Adotivo tem diferença de idade inferior a 16 anos com o adotante ou seu conjuge", 'danger');
                
                return redirect('vinculos/adotivo/'.$adotivo->id."#tab_vinculo_atual");
            }

            (new Vinculo())->vincular($adotivo, $adotante);
            
            flash("Adotivo ".$adotivo->nome." vinculado(a) com Sucesso!", "success");

            return redirect('vinculos/adotivo/'.$adotivo->id."#tab_vinculo_atual");
        }
        return redirect()->action('AcessoNegadoController@index');
    }

    public function desvincular(Request $request) 
    {
        $adotivo = Adotivo::find($request->get('id_adotivo'));
        if (Gate::allows('has_access',  $adotivo)) {
            
            (new Vinculo())->desvincular($adotivo, $request);

            return json_encode(['status' => true]);
        }
        return redirect()->action('AcessoNegadoController@index');
    }
}
