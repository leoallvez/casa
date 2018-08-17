<?php
namespace Casa;

use Illuminate\Database\Eloquent\Model;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class Estado extends Model 
{
    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function adotantes()
    {
    	return $this->hasMany('Casa\Adotante', 'estado_id');
    }

    public function instituicoes() 
    {
        return $this->hasMany('Casa\Instituicao', 'estado_id');
    }
}
