<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class AdotivoStatus extends Model {
    protected $table = 'adotivos_status';

    public function adotivos() {
        return $this->hasMany('Casa\Adotivo');
    }
}
