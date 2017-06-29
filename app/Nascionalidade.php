<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class Nascionalidade extends Model {
	
	public function adotivos() {
        return $this->hasMany('Casa\Adotivo');
    }
}
