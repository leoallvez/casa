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
