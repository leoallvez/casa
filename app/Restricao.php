<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class Restricao extends Model {
    protected $table = 'restricoes';

    public function adotivo() {
        return $this->belongsTo('Casa\Adotivo','restricao_id');
    }
}
