<?php

namespace Casa;
use Illuminate\Database\Eloquent\Model;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class Etnia extends Model 
{
    const BRANCO   = 1;
    const NEGRO    = 2;
    const INDIGENA = 3;
    const MULATO   = 4;
    const CABLOCO  = 5;
    const CAFUZO   = 6;
    const PARDO    = 7;
    
    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function adotivos() 
    {
        return $this->hasMany('Casa\Adotivo');
    }
}
