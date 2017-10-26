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
        $this->data = date('Y-m-d');
    }
}
