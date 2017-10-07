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
    ];
    
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


