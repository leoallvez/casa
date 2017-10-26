<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class AdmInstituicao extends Model
{
    public function __construct(array $attributes = array(), $password = null) {
        parent::__construct($attributes, $password,  UsuarioNivel::ADM_INSTITUICAO);
    }

    /**
     * @return Colletion de Usuario.
     */
    public static function listar() 
    {
        $adm = self::where('nivel_id','=', UsuarioNivel::ADM_INSTITUICAO);
        return $adm->orderBy('name')->paginate(config('app.list_size'));
    }

    public static function buscar($request, $nivel = UsuarioNivel::ADM_INSTITUICAO) 
    {
        return parent::buscar($request, $nivel);
    }
}
