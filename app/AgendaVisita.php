<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class AgendaVisita extends Model {

    public $timestamps = false;
    
    protected $table = 'events';

    protected $fillable = [
        'title',
        'color',
        'date',
        'description',
    ];
}
