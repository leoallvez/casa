<?php

namespace Casa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model {

    public $timestamps = false;
    //protected $table = 'events';

    public function __construct(array $attributes = array()) 
    {
        parent::__construct($attributes);
        $this->usuario_id = Auth::id() ?? 1;
        $this->instituicao_id = Auth::user()->instituicao_id ?? 1;
    }

    // protected $fillable = [
    //     'title',
    //     'color',
    //     'date',
    //     'description',
    // ];

    protected $fillable = [
        'dia',
        'hora_inicio',
        'hora_fim',
        'status',
        'opiniao_adotantes',
        'opiniao_adotivos',
        'observacoes',
    ];

    public function visitas()
    {
        return $this->hasMany('Casa\Visita');
    }
}
