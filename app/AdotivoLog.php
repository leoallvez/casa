<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

/**
* Responsável por criar os logs dos adotivos.
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/

class AdotivoLog extends Model 
{
    public $timestamps = false;
    protected $table = "adotivos_logs";
    
    public function __construct(Adotivo $adotivo) 
    {
        $this->adotivoJSON = $adotivo->toJson();
        $this->adotivo_id = $adotivo->id;
        $this->data = date('Y-m-d');
    }

    public function salvar() 
    {
        $this->save();
    }

    public function altualizarOuSalvar() : boolean
    {
        $lastAdotivoLog = self::where('adotivo_id', $this->adotivo_id)
        ->where('data', date('Y-m-d'))
        ->last();
        //Fazer update.
        if(!is_null($lastAdotivoLog)) {
            $lastAdotivoLog->adotivoJSON = $this->adotivoJSON; 
            $lastAdotivoLog->update();
            return true;
        }
        //Fazer o create.
        $this->salve();
        return false;
    }
}
