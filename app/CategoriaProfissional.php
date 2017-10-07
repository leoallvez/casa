<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class CategoriaProfissional extends Model 
{
    protected $table = 'categorias_profissionais';
    
    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function adotantes(){
    	return $this->hasMany('Casa\Adotante', 'adotante_id');
    }
}
