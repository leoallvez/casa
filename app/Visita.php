<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visita extends Model {
    use SoftDeletes;

    protected $dates = ['dia'];

    protected $fillable = [
    	'adotivo_id',
    	'adotante_id',
    	'dia',
    	'hora', 
    	'minuto',
        'tempo_estimado'
    ];

    public function adotante() {
    	return $this->belongsTo('Casa\Adotante', 'adotante_id');
    }

    public function adotivo() {
    	return $this->belongsTo('Casa\Adotivo', 'adotivo_id');
    }
}


