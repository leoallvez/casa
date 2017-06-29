<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class Escolaridade extends Model {

	public function adotantes(){
    	return $this->hasMany('Casa\Adotante', 'estado_id');
    }
}
