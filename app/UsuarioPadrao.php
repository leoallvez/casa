<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class UsuarioPadrao extends Model
{
    public function __construct(array $attributes = array(), $password = null) {
        parent::__construct($attributes, $password,  UsuarioNivel::PADRAO);
    }

    /**
     * @return Colletion de Usuario.
     */
    public static function listar() 
    {
        $adm = self::where('nivel_id','=', UsuarioNivel::PADRAO);
        return $adm->orderBy('name')->paginate(config('app.list_size'));
    }

    /**
     * @return Colletion de Usuario.
     */
    public static function buscar($request, $nivel = UsuarioNivel::PADRAO) 
    {
        return parent::buscar($request, $nivel);
    }
}
