<?php

namespace Casa;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * [isAdmin description]
     * Define se o usuário é um admistrador do sistema ou
     * admistrador da instituição.
     * @return boolean [description]
     */

    public function instituicao() {
        return $this->belongsTo('Casa\Instituicao', 'instituicao_id');
    }

    public function isAdm() {
        return $this->nivel_id == 1 || $this->nivel_id == 2;
    }

    public function isAdmSistema() {
        return $this->nivel_id == 1;
    }

    public function isAdmInstituicao() {
        return $this->nivel_id == 2;
    }

    public function isUsuarioPadrao() {
        return $this->nivel_id == 3;
    }

    public function isAdmInsOrUsuarioPadrao() {
        return $this->nivel_id == 2 ||  $this->nivel_id == 3;
    }

    /**
     * [isAdmin description]
     * Retorna o nível de usuario que o usurio logado pode
     * cadastrar.
     * @return int [description]
     */

    public function getNivelCadastro() {
        if($this->isAdmSistema()) {
            return 1;
        }

       if($this->isAdmInstituicao()) {
            return 3;
        }
    }
}
