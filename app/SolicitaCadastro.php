<?php

namespace Casa;
use Illuminate\Database\Eloquent\Model;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class SolicitaCadastro extends Model {

    protected $fillable = [
    	#Dados Instituição
    	'is_aprovado',
    	'razao_social',
    	'cnpj',
    	'telefone',
    	'endereco',
    	'complemento',
    	'cep',
    	'bairro',
    	'cidade',
    	'estado',
    	'email_instituicao',
    	'motivo_reprovacao',
    	# Dados Admistrador.
    	'nome',
    	'cargo',
    	'cpf',
    	'email_adminstrador',
    	'password',
        'password_confirmation'
    ];
}
