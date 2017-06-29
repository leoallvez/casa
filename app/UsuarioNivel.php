<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class UsuarioNivel extends Model {

    protected $table = 'niveis_usuarios';

    public function usuarios() {
    	return $this->hasMany('Casa\Usuario', 'user_id');
    }
}
