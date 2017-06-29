<?php

namespace Casa;
use Illuminate\Database\Eloquent\Model;

class Etnia extends Model {

 	public function adotivos() {
        return $this->hasMany('Casa\Adotivo');
    }
}
