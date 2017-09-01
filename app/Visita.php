<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visita extends Model {
    //use SoftDeletes;

    protected $fillable = [
    	'agenda_id',
    	'vinculo_id',
    ];

    public function agenda()
    {
        return $this->belongsTo('Casa\Agenda', 'agenda_id');
    }

    public function vinculo()
    {
        return $this->belongsTo('Casa\Vinculo', 'vinculo_id');
    }
}


