<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model {
    
    protected $table = 'adotantes_adotivos';

    protected $dates = ['created_at'];
}
