<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class AdotivoLog extends Model {

    public $timestamps = false;
    protected $table = "adotivos_logs";
    
    public function __construct(Adotivo $adotante) {
        $this->adotivoJSON = $adotante->toJson();
        $this->data = date('Y-m-d');
    }
}
