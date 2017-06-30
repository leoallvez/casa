<?php

namespace Casa\Http\Controllers;

use Casa\Adotivo;
use Casa\Adotante;
use Illuminate\Http\Request;
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
        /** [description] Listagem do histórico adotantes*/
    	$adotantesHistorico = $adotivo->adotantes()
    	->orderBy('adotantes_adotivos.created_at')
        
    	->where('adotantes_adotivos.adotivo_id', '=', $id)
    	->where('adotantes_adotivos.deleted_at', '!=', null);;
        /** 
         * Caso o adotivo tenha vínculo trazer o id do adotivo, 
         * senão null. 
        */
        $idAdotanteVinculo = $adotivo->adotantes()
        ->where('adotantes.has_vinculo','=', 1)
        ->first()['id'];

    	$adotantes = Adotante::orderBy('nome')
        ->where('adotantes.instituicao_id', Auth::user()->instituicao_id)
        ->get();
        /**
         * Tirar da listagem de adotantes disponiveis os adotantes
         * que já tiverram vínculo com o adotivo.
         */
        
        $adotantes = $adotantes->diff($adotantesHistorico->get());

        $adotantesHistorico = $adotantesHistorico->paginate(10); 
        /** Nome de adotate com conjuge caso tenha. */
    	foreach ($adotantes as $adotante) {
    		$adotante->nome = $adotante->getNomeEnomeConjuge(); 
    	}
     
    	$adotantes = $adotantes->pluck('nome', 'id');
   
		return view('vinculo.index', compact(
            'adotivo', 
            'adotantesHistorico', 
            'adotantes', 
            'idAdotanteVinculo'
        ));   
    }

    public function visualizar($adotivo_id, $adotante_id) {
    	
        $adotivo = Adotivo::find($adotivo_id);

        $adotantes = $adotivo->adotantes()
    	->where('adotantes_adotivos.adotante_id', '=', $adotante_id)
        ->first();
        return view('vinculo.visualizar', compact('adotivo', 'adotantes')); 	
    }

    public function vincular(VinculoRequest $request) {

        $adotivo = Adotivo::find($request->adotivo_id);
        $adotante = Adotante::find($request->adotante_id);
        # Não podem tem menos 16 anos de diferença.
        if(!$adotivo->HasSixteenYearsApart($adotante)) {
            flash("Adotivo tem diferença de idade inferior a 16 anos com o adotante ou seu conjuge", 'danger');
            return redirect('vinculos/adotivo/'.$adotivo->id);
        }

        $adotivo->status_id = 3;

        $adotante->has_vinculo = 1;

        $adotivo->adotantes()->save($adotante);
        $adotivo->save();
        flash("Adotivo ".$adotivo->nome." vinculado(a) com Sucesso!", "success");
        return redirect('vinculos/adotivo/'.$adotivo->id);
    }

    public function desvincular(Request $request) {

        $adotivo = Adotivo::find($request->get('id_adotivo'));

        $adotante = $adotivo->adotantes()->where('adotantes.has_vinculo', '=', 1)->first();
        $adotivo->status_id = 2;
        $adotante->has_vinculo = 0;
        $adotante->save();

        $adotivo->adotantes()
        ->updateExistingPivot($adotante->id, ['observacoes' => $request->get('observacoes') , 'deleted_at' => date("Y-m-d G:i:s")]);
        
        $adotivo->save();

        return json_encode(['status' => true]);
    }
}
