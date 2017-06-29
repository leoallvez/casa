<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class Irmao extends Model {
    protected $table = 'irmaos';

    public function adotivo(){
        return $this->belongsToMany('Casa\Adotivo');
    }
}
