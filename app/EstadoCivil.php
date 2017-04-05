<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model {
    protected $table = 'estados_civis';

    public function adotantes(){
    	return $this->hasMany('Casa\Adotante', 'estado_id');
    }
}
