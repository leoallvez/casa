<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model {
    
    public function adotantes(){
    	return $this->hasMany('Casa\Adotante', 'estado_id');
    }

    public function instituicoes() {
        return $this->hasMany('Casa\Instituicao', 'estado_id');
    }
}
