<?php

namespace Casa;
use Illuminate\Database\Eloquent\Model;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class EstadoCivil extends Model 
{
    protected $table = 'estados_civis';
    const SOLTEIRO      = 1;
    const CASADO        = 2;
    const DIVORCIADO    = 3;
    const VIUVO         = 4;
    const SEPARADO      = 5;
    const UNIAO_ESTAVEL = 6;

    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function adotantes()
    {
    	return $this->hasMany('Casa\Adotante', 'estado_id');
    }
}
