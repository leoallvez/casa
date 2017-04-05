<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class Origem extends Model {
    protected $table = 'origens';

    public function adotivos() {
        return $this->hasMany('Casa\Adotivo');
    }
}
