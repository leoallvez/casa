<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instituicao extends Model {
	use SoftDeletes;
	
	protected $table = 'instituicoes';

	protected $dates = [
        'created_at'
    ];

	protected $fillable = [
		'is_aprovada',
		'razao_social',
		'cnpj',
		'telefone',
		'endereco',
		'endereco_numero',
		'complemento',
		'cep',
		'bairro',
		'cidade',
		'email',
		'observacoes',
		'estado_id'
	];

	public function setIsAprovada($is_aprovada) {
		$this->is_aprovada = $is_aprovada;	
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getAdm() {

		$usuario = Usuario::where('instituicao_id', $this->id)->whereIn('nivel_id', [1,2])->first();

		return $usuario->name ?? 'Não encontrado';
	}

	public function adotivos() {
        return $this->hasMany('Casa\Adotivo');
    }

    public function estado() {
    	return $this->belongsTo('Casa\Estado', 'estado_id');
	}

	public function usuarios() {
    	return $this->hasMany('Casa\Usuario', 'user_id');
    }
}
