<?php
namespace Casa;

use Illuminate\Database\Eloquent\Model;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class AdotivoStatus extends Model 
{
    protected $table = 'adotivos_status';

    # constantes com status de adotivos
    const INDISPONIVEL_PARA_ADOCAO = 1;
    const DISPONIVEL_PARA_ADOCAO   = 2;
    const RECEBENDO_VISITA         = 3;
    const GUARDA_PROVISORIA        = 4;
    const ADOTADO                  = 5;

    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function adotivos() 
    {
        return $this->hasMany('Casa\Adotivo');
    }
}
