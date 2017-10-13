<?php

namespace Casa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class Instituicao extends Model 
{
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

	/**
    * @return void
    */
	public function setIsAprovada($is_aprovada) : void
	{
		$this->is_aprovada = $is_aprovada;	
	}

	/**
    * @return void
    */
	public function setEmail($email) : void
	{
		$this->email = $email;
	}

	/**
    * @return string
    */
	public function getAdm() : string
	{
		$usuario = Usuario::where('instituicao_id', $this->id)
		->whereIn('nivel_id', [UsuarioNivel::ADM_SISTEMA , UsuarioNivel::ADM_INSTITUICAO])
		->first();

		return $usuario->name ?? 'Não encontrado';
	}

	/**
    * @return void
    */
	public function atualizar(array $request) : void
	{
		$admAtual = Usuario::find($request['adm_id']);
		
		if($admAtual->id == $request['old_adm_id']) {
			$admAtual->update($request);
		} else {
			# Atualizar novo ADM.
			$admAtual->update([
				'nivel_id' => UsuarioNivel::ADM_INSTITUICAO, 
				'cargo'    => $request['cargo']
			]);
			# Atualizar ADM antigo como usuário padrão.
			$admAntigo = Usuario::find($request['old_adm_id']);

			$admAntigo->update(['nivel_id' => UsuarioNivel::PADRAO]);
			# Anativar ADM antigo.
			if(array_key_exists("inativar_old_adm", $request)) {
				$admAntigo->delete();
			}
		}
		$this->update($request);
	}

	/**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
	public function adotivos() 
	{
        return $this->hasMany('Casa\Adotivo');
    }

	public function estado() 
	{
    	return $this->belongsTo('Casa\Estado', 'estado_id');
	}

	public function usuarios() 
	{
    	return $this->hasMany('Casa\Usuario', 'user_id');
    }
}
