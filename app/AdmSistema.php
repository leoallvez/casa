<?php

namespace Casa;

#use Illuminate\Database\Eloquent\Model;

class AdmSistema extends Usuario {

    private const NIVEL = 1;

    public function __construct(array $attributes = array(), $password = null) {
       
        parent::__construct($attributes, $password, self::NIVEL);
    }

    /**
     * @return Colletion de Usuario.
     */
    public static function list() {

        $adm = self::where('nivel_id','=', self::NIVEL);
        return $adm->orderBy('name')->paginate(10);
    }

    public static function fetch($request, $nivel = self::NIVEL) {
        return parent::fetch($request, $nivel);
    }
}
