<?php
namespace Casa;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

/**
* Responsável por criar, atualizae e busca 
* os logs dos adotivos pesquisados no relatório.
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/

class AdotivoLog extends Model 
{
    public $timestamps = false;
    protected $table = "adotivos_logs";

    protected $fillable = [
        'adotivo_status_id',
        'adotivo_etnia_id',
        'adotivo_idade',
        'adotivoJSON',
        'adotivo_id',
        'data',
    ];

    public function setAll(Adotivo $adotivo, $data = null) : void
    {
        $data = $data ?? date('Y-m-d');
        
        $this->adotivo_status_id = $adotivo->status_id;
        $this->adotivo_etnia_id  = $adotivo->etnia_id ;
        $this->instituicao_id    = Auth::user()->instituicao_id ?? 2; //TODO: remover o 2 de teste.
        $this->adotivo_idade     = $adotivo->getIdadeAsInt();
        $this->adotivo_sexo      = $adotivo->sexo;
        $this->adotivoJSON       = $adotivo->toJson();
        $this->adotivo_id        = $adotivo->id;
        $this->data              = $data;
    }

    public function salvar() 
    {
        $this->save();
    }

    public function altualizarOuSalvar() : void
    {
        $adotivoLogHoje = self::getAdotivoLogHoje();
        // Caso o adotivo tiver log na data de hoje atualizar
        if (!is_null($adotivoLogHoje)) {
            $this->id = $adotivoLogHoje->id;
            $adotivoLogHoje = $this;
            $adotivoLogHoje->update();
        } else {
            // Senão criar um log novo.
            $this->save();
        }
    }

    private function getAdotivoLogHoje()
    {
        return self::where('adotivo_id', $this->adotivo_id)
            ->where('data', date('Y-m-d'))->get()->last();
    }

    public static function pesquisar($request) 
    {
        $resultado = self::where('instituicao_id', Auth::user()->instituicao_id);

        if (!empty($request['data_inicio']) && !empty($request['data_fim']) ) {
            
            $resultado = $resultado->whereBetween('data', 
                [$request['data_inicio'], $request['data_fim']]
            );  
        }

        if (!empty($request['sexo'])) {
            $resultado = $resultado->where('adotivo_sexo', $request['sexo']);    
        }

        if (!empty($request['idade'])) {
            $resultado = $resultado->where('adotivo_idade', $request['idade']);    
        }

        if (!empty($request['etnia'])) {
            $resultado = $resultado->where('adotivo_etnia_id', $request['etnia']);    
        }

        if (!empty($request['status'])) {
            $resultado = $resultado->where('adotivo_status_id', $request['status']);    
        }

        return $resultado->get();
    }
}
