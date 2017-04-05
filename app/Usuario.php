<?php

namespace Casa;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model {
    
    use SoftDeletes;

    protected $dates = ['created_at'];

    protected $table = "users";

    protected $fillable = [
    	'name',
    	'email',
    	'password',
    	'cpf',
    	'cargo',
    	'nivel_id',
        'instituicao_id',
        'created_at'
    ];

    public function setNivel($nivel_id) {
        $this->nivel_id = $nivel_id;
    }
    /**
     * Cria uma hash para a senha informada.
     * @param string $password 
     * @return void
     */
    public function setSenha($password) {
        $this->password = Hash::make($password);
    }

    public function setInstituicao($instituicao_id) {
        $this->instituicao_id = $instituicao_id;   
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function nivel() {
        return $this->belongsTo('Casa\UsuarioNivel', 'nivel_id');
    }

    public function instituicao() {
        return $this->belongsTo('Casa\Instituicao', 'instituicao_id');    
    }
}
