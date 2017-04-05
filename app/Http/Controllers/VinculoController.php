<?php

namespace Casa\Http\Controllers;

use Casa\Adotivo;
use Casa\Adotante;
use Illuminate\Http\Request;

class VinculoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) {
    	$adotivo = Adotivo::find($id);

    	$adotantesHistorico = $adotivo->adotantes()
    	->orderBy('adotantes_adotivos.created_at')
    	->where('adotantes_adotivos.adotivo_id', '=', $id)
    	->where('adotantes_adotivos.deleted_at', '!=', null)
    	->paginate(10); 

    	$adotantes = Adotante::orderBy('nome')->get();

    	foreach ($adotantes as $adotante) {
    		$adotante->nome = $adotante->getNomeEnomeConjuge(); 
    	}

    	$adotantes = $adotantes->pluck('nome', 'id');
   
		return view('vinculo.index', compact('adotivo', 'adotantesHistorico', 'adotantes'));   
    }

    public function visualizar($adotivo_id, $adotante_id) {
    	

        $adotivo = Adotivo::find($adotivo_id);

         $adotantes = $adotivo->adotantes()
    	->where('adotantes_adotivos.adotante_id', '=', $adotante_id)->first();
        // $adotantes = Adotante::find($adotante_id);

        return view('vinculo.visualizar', compact('adotivo', 'adotantes')); 
    	/**When working with a many-to-many relationship, the save method accepts an array of additional intermediate table attributes as its second argument:
		App\User::find(1)->roles()->save($role, ['expires' => $expires]); */
    }
}
