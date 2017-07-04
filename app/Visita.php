<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visita extends Model {
    use SoftDeletes;

    protected $dates = ['dia'];

    protected $fillable = [
    	'dia',
    	'hora_inicio',
    	'hora_fim',
    	'status', 
    	'minuto',
        'tempo_estimado',
        'opiniao_adotantes',
        'opiniao_adotivos',
        'observacoes',
        # FK
        'instituicao_id',
    ];

    public function adotante() {
    	return $this->belongsTo('Casa\Adotante', 'adotante_id');
    }

    public function adotivo() {
    	return $this->belongsTo('Casa\Adotivo', 'adotivo_id');
    }
}


