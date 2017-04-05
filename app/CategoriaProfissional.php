<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class CategoriaProfissional extends Model {
    protected $table = 'categorias_profissionais';
    
    public function adotantes(){
    	return $this->hasMany('Casa\Adotante', 'estado_id');
    }
}
