<?php

namespace Casa;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * [description]
     * Define se o usuário é um admistrador do sistema ou
     * admistrador da instituição.
     * @return boolean [description]
     */

    public function instituicao() 
    {
        return $this->belongsTo('Casa\Instituicao', 'instituicao_id');
    }

    public function isAdm() : bool
    {
        return $this->nivel_id == UsuarioNivel::ADM_SISTEMA || $this->nivel_id == UsuarioNivel::ADM_INSTITUICAO;
    }

    public function isAdmSistema() : bool
    {
        return $this->nivel_id == UsuarioNivel::ADM_SISTEMA;
    }

    public function isAdmInstituicao() : bool
    {
        return $this->nivel_id == UsuarioNivel::ADM_INSTITUICAO;
    }

    public function isUsuarioPadrao() : bool
    {
        return $this->nivel_id == UsuarioNivel::PADRAO;
    }

    public function isAdmInsOrUsuarioPadrao() : bool
    {
        return $this->nivel_id == UsuarioNivel::ADM_INSTITUICAO || $this->nivel_id == UsuarioNivel::PADRAO;
    }

    /**
     * [description]
     * Retorna o nível de usuario que o usurio logado pode
     * cadastrar.
     * @return int [description]
     */

    public function getNivelCadastro() : int 
    {
        if($this->isAdmSistema()) {
            return UsuarioNivel::ADM_SISTEMA;
        }

       if($this->isAdmInstituicao()) {
            return UsuarioNivel::PADRAO;
        }
    }
}
