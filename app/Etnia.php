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
