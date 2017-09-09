<?php

namespace Casa;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adotante extends Model {
  use SoftDeletes;

  protected $dates = [
    'created_at',
    'nascimento',
    'conjuge_nascimento'
  ];

  protected $fillable = [
  	'nome',
  	'sexo',
  	'nascimento',
  	'cpf',
  	'rg',
  	'endereco',
    'endereco_numero',
  	'complemento',
  	'cep',
  	'bairro',
  	'cep',
  	'bairro',
  	'cidade',
  	'telefone',
  	'celular',
  	'email',
    'buscar',
    # Conjuge
    'conjuge_nome',
    'conjuge_sexo',
    'conjuge_nascimento',
    'conjuge_cpf',
    'conjuge_rg',
    'conjuge_escolaridade_id',
    'conjuge_nascionalidade_id',
    'conjuge_categoria_profissional_id',
    # FK
    'estado_id',
    'estado_civil_id',
    'escolaridade_id',
    'nacionalidade_id',
    'categoria_profissional_id'
  ];

  public function setInstituicao(int $id) {
    $this->instituicao_id = $id;
  }

  public function setUsuario(int $id) {
    $this->usuario_id = $id;
  }

  /**
   * Esse metódo altera o nome o conjuge para nulo caso seja alterado o estado civil
   * para um valor diferende de casado ou únião estável.
   * @param type $request
   * @return type
   */
  public static function validarConjuge(&$request) {
    if($request['estado_civil_id'] != 2 && $request['estado_civil_id'] != 6) {

      $conjugeAtributos = [
        'conjuge_rg',
        'conjuge_cpf',
        'conjuge_sexo',
        'conjuge_nome',
        'conjuge_nascimento',
        'conjuge_escolaridade_id',
        'conjuge_categoria_profissional_id'
      ];

      foreach ($conjugeAtributos as $atributo ) {
        $request[$atributo] = null;
      }
    }

  }

  public function setHasVinculo(bool $value) {
    $this->has_vinculo = $value;
  }

  /**
   * Esse metodo retorna a idade de um adotante
   * @return int
   */
  public function getIdade() {
    # Diferença entre a data de nascimento e do dia de hoje.
    return $this->nascimento->diffInYears(Carbon::now());
  }
  public function getNomeEnomeConjuge() {
    $result = $this->nome;
    $result .= (isset($this->conjuge_nome) && $this->conjuge_nome != "" )? " --- ".$this->conjuge_nome : null;
    return  $result ;
  }
  /**
   * Esse metodo retorna se o sexo do adotante é masculino ou
   * feminino
   * @return string
   */

  public function getSexo() {
    return ($this->sexo == 'M')? 'Masculino' : 'Feminino';
  }

  public function hasAdotivos() {
    return $this->has_vinculo;
  }

  public function hasConjuge() {
    return ($this->estado_civil_id == 2 || $this->estado_civil_id == 6);
  }

  public function adotivos() {
    return $this->belongsToMany('Casa\Adotivo', 'adotantes_adotivos')
    ->withPivot('created_at', 'deleted_at');
  }

  public function estado() {
  	return $this->belongsTo('Casa\Estado', 'estado_id');
  }

  public function estadoCivil() {
  	return $this->belongsTo('Casa\EstadoCivil', 'estado_civil_id');
  }

  public function escolaridade() {
    return $this->belongsTo('Casa\Escolaridade', 'escolaridade_id');
  }

  public function categoriaProfissional() {
    return $this->belongsTo('Casa\CategoriaProfissional', 'categoria_profissional_id');
  }

  // public function visitas() {
  //   return $this->hasMany('Casa\Visita', 'adotante_id');
  // }

  public function vinculos() {
      return $this->hasMany('Casa\Vinculo', 'adotante_id');
  }

  public function observacoes() {
    return $this->belongsToMany(Adotivo::class, 'adotantes_adotivos')
    ->withPivot('observacoes')
    ->orderBy('id', 'desc')
    ->get()->first()
    ->pivot->observacoes;
  }
}
