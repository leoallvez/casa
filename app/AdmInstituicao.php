<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class AdmInstituicao extends Model
{
    public function __construct(array $attributes = array(), $password = null) {
        parent::__construct($attributes, $password,  UsuarioNivel::ADM_INSTITUICAO);
    }
}
