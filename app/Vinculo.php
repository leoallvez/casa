<?php

namespace Casa;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

/**
* @package Casa
* @author  Leonardo Alves <leoallvez@hotmail.com>
* @access  public
*/

class Vinculo extends Model 
{
    protected $table = 'adotantes_adotivos';
    protected $dates = ['created_at'];
    protected $fillable = ['adotante_id', 'adotivo_id'];

    /**
     * Lista todos os adotantes da instituição que posssuem vinculos.
     * @return array de collections
     */
    public function listarAdotantesComViculos()
    {
        $adotantes = [];

        $adotantes_ids = self::where('deleted_at', null)->pluck('adotante_id');

        $adotantes = Adotante::whereIn('id', $adotantes_ids)
            ->where('instituicao_id', Auth::user()->instituicao_id)
            ->get();

        if (!$adotantes->isEmpty()) {
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
    * @return array
    */
    public function listarAdotivosComVinculo() : array
    {
        $adotivosVinculos = self::where('deleted_at', null)
            ->pluck('adotivo_id', 'id')->toArray();

        foreach ($adotivosVinculos as $key => $value) {
           
            $adotivo = Adotivo::where('id', $value)
                ->where('instituicao_id', Auth::user()->instituicao_id)
                ->first();

            if (!is_null($adotivo)) {
                $adotivos[$key] = $adotivo->nome;
            }
        }
        return $adotivos ?? [];
    }

    /**
    * @return array
    */
    public function getAdotivosByAdotantesId(int $id) : array
    {
        return self::where('adotante_id', $id)
            ->where('deleted_at', null)
            ->pluck('id')
            ->toArray();
    }

    /**
    * @return array
    */
    public function vincular(Adotivo $adotivo, Adotante $adotante) : void 
    {
        $adotivo->status_id = AdotivoStatus::RECEBENDO_VISITA;
        $adotante->tem_vinculo = Adotante::TEM_VINCULO;
        $adotivo->adotantes()->save($adotante);
        $adotivo->save();
    }

    /**
    * @return array
    */
    public function desvincular(Adotivo $adotivo, $request) : void
    {
        $adotante = $adotivo->adotantes()
            ->where('adotantes.tem_vinculo', '=', Adotante::TEM_VINCULO)->first();

        $adotivo->status_id = AdotivoStatus::DISPONIVEL_PARA_ADOCAO;
        $adotante->tem_vinculo = (!Adotante::TEM_VINCULO);
        $adotante->save();

        $adotivo->adotantes()
            ->updateExistingPivot($adotante->id, [
                'observacoes' => $request->get('observacoes') , 
                'deleted_at' => date("Y-m-d G:i:s"),
            ]);

        $adotivo->save();
    }

    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
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
