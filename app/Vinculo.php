<?php
namespace Casa;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model {
    
    protected $table = 'adotantes_adotivos';

    protected $fillable = [
    	'adotante_id',
    	'adotivo_id',
    ];

    protected $dates = ['created_at'];

    /**
     * Lista todos os adotantes da instituição que posssuem vinculos.
     * @return array de collection
     */
    public function listarAdotantesComViculos() {

        $adotantes_ids = self::where('deleted_at', null)->pluck('adotante_id');

        $adotantes = Adotante::whereIn('id', $adotantes_ids)
        ->where('instituicao_id', Auth::user()->instituicao_id)
        ->get();

        if(!$adotantes->isEmpty()) {
            foreach ($adotantes as $adotante) {
                $adotante->nome = $adotante->getNomeEnomeConjuge(); 
            }
            $adotantes = $adotantes->pluck('nome', 'id');
        }

        return $adotantes;
    }

    /**
     * Lista todos os adotivos da instituição que posssuem vinculos
     * é retornado um array sendo que o indice do array é o número 
     * do vínculo e não o id do adotivo.
     *
     * @return array
     */

    public function listarAdotivosComVinculo() {

        $adotivosVinculos = self::where('deleted_at', null)->pluck('adotivo_id', 'id')->toArray();

        foreach($adotivosVinculos as $key => $value) {
           
            $adotivo = Adotivo::where('id', $value)
            ->where('instituicao_id', Auth::user()->instituicao_id)
            ->first();

            if(!is_null($adotivo))
                $adotivos[$key] = $adotivo->nome;
        }
        return $adotivos ?? [];
    }

    /**
     *
     * @return array
     */

    public function getAdotivosByAdotantesId(int $id) {

        return self::where('adotante_id', $id)
        ->where('deleted_at', null)
        ->pluck('id')
        ->toArray();

    }

    public function visitas()
    {
        return $this->hasMany('Casa\Visita');
    }

    public function adotivo()
    {
        return $this->belongsTo('Casa\Adotivo', 'adotivo_id');
    }

    public function adotante()
    {
        return $this->belongsTo('Casa\Adotante', 'adotante_id');
    }
}
