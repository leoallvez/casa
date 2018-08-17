<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class UsuarioNivel extends Model 
{
    protected $table = 'niveis_usuarios';
    # Nivies de usuários
    const ADM_SISTEMA      = 1;
    const ADM_INSTITUICAO  = 2;
    const PADRAO           = 3;
    const CANDIDATO        = 4;

    /**
    * @return array
    */
    public static function listar()
    {
        return self::where('id', '<>', self::CANDIDATO)->pluck('nome', 'id');
    }

    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function usuarios() 
    {
    	return $this->hasMany('Casa\Usuario', 'user_id');
    }
}
