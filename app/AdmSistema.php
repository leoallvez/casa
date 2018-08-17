<?php

namespace Casa;

/**
* Responsável pelos usuários do sistema.
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class AdmSistema extends Usuario 
{
    public function __construct(array $attributes = array(), $password = null) 
    {
        parent::__construct($attributes, $password, UsuarioNivel::ADM_SISTEMA);
    }
}
