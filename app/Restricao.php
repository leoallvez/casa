<?php

namespace Casa;
use Illuminate\Database\Eloquent\Model;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class Restricao extends Model 
{
    protected $table = 'restricoes';

    const NAO_POSSUI          = 1;
    const DOENCA_TRATAVEL     = 2;
    const DOENCA_NAO_TRATAVEL = 3;
    const DEFICIENCIA_FISICA  = 4;
    const DEFICIENCIA_MENTAL  = 5;
    const VIRUS_HIV           = 6;
    
    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function adotivo() 
    {
        return $this->belongsTo('Casa\Adotivo','restricao_id');
    }
}
