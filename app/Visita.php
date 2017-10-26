<?php

namespace Casa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class Visita extends Model 
{
    protected $fillable = [
    	'agenda_id',
        'vinculo_id',
        'opiniao_adotante',
        'opiniao_adotivo',
        'is_registada',
    ];

    public function getAdotanteNome() : string
    {
        return $this->vinculo->adotante->nome;
    }

    public function getAdotanteConjugeNome() 
    {
        return $this->vinculo->adotante->conjuge_nome;
    }

    public function getAdotivoNome() : string
    {
        return $this->vinculo->adotivo->nome;
    }
    
    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function agenda()
    {
        return $this->belongsTo('Casa\Agenda', 'agenda_id');
    }

    public function vinculo()
    {
        return $this->belongsTo('Casa\Vinculo', 'vinculo_id');
    }
}


