<?php

namespace Casa;
use Illuminate\Database\Eloquent\Model;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class Irmao extends Model 
{
    protected $table = 'irmaos';

    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function adotivo()
    {
        return $this->belongsToMany('Casa\Adotivo');
    }
}
