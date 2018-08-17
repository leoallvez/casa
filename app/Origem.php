<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class Origem extends Model 
{
    protected $table = 'origens';
    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */

    public function adotivos() {
        return $this->hasMany('Casa\Adotivo');
    }
}
