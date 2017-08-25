<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class Nacionalidade extends Model {
	
	public function adotivos() {
        return $this->hasMany('Casa\Adotivo');
    }
}
