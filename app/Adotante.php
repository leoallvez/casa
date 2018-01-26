<?php

namespace Casa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class Adotante extends Model
{
  use SoftDeletes;

  const TEM_VINCULO = true;

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

  /**
   * @return void
   */
  public function setInstituicao(int $id) : void
  {
    $this->instituicao_id = $id;
  }

   /**
   * @return void
   */
  public function setUsuario(int $id) : void
  {
    $this->usuario_id = $id;
  }

  /**
   * Altera o nome o conjuge para nulo caso seja alterado o estado civil
   * para um valor diferende de casado ou únião estável.
   * @param type $request
   * @return void
   */
  public static function validarConjuge(&$request) : void
  {
    if($request['estado_civil_id'] != EstadoCivil::CASADO && $request['estado_civil_id'] != EstadoCivil::UNIAO_ESTAVEL) {

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

   /**
   * @return void
   */
  public function setTemVinculo(bool $value) : void
  {
    $this->tem_vinculo = $value;
  }

  /**
   * Retorna a idade de um adotante
   * @return int
   */
  public function getIdade() : int
  {
    # Diferença entre a data de nascimento e do dia de hoje.
    return $this->nascimento->diffInYears(Carbon::now());
  }

  /**
     * Método(s) do Eloquent 
     * Definem as relações das models.
     */
  public function getNomeEnomeConjuge() : string
  {
    $result = $this->nome;
    $result .= (isset($this->conjuge_nome) && $this->conjuge_nome != "" )? " --- ".$this->conjuge_nome : null;
    return  $result;
  }

  public function buscar($valor_de_busca) {

    return self::where('nome', 'like', '%'.$valor_de_busca.'%')
          ->where('adotantes.instituicao_id', Auth::user()->instituicao_id)
          ->orWhere('cpf','=', setMascara($valor_de_busca, '###.###.###-##'))
          ->orderBy('nome')
          ->paginate(config('app.list_size'));
  }

  /**
   * Esse metodo retorna se o sexo do adotante é masculino ou
   * feminino
   * @return string
   */
  public function getSexo() : string
  {
    return ($this->sexo == 'M')? 'Masculino' : 'Feminino';
  }

  /**
  * @return bool
  */
  public function hasAdotivos() : bool 
  {
    return $this->tem_vinculo;
  }

  /**
  * @return bool
  */
  public function hasConjuge() : bool
  {
    return ($this->estado_civil_id == EstadoCivil::CASADO || $this->estado_civil_id == EstadoCivil::UNIAO_ESTAVEL);
  }

  /**
  * [description]
  * Método(s) do Eloquent 
  * Definem as relações das models.
  */
  public function adotivos()
  {
    return $this->belongsToMany('Casa\Adotivo', 'adotantes_adotivos')
    ->withPivot('created_at', 'deleted_at');
  }

  public function estado() 
  {
  	return $this->belongsTo('Casa\Estado', 'estado_id');
  }

  public function estadoCivil() 
  {
  	return $this->belongsTo('Casa\EstadoCivil', 'estado_civil_id');
  }

  public function escolaridade() 
  {
    return $this->belongsTo('Casa\Escolaridade', 'escolaridade_id');
  }

  public function categoriaProfissional() 
  {
    return $this->belongsTo('Casa\CategoriaProfissional', 'categoria_profissional_id');
  }

  public function vinculos() 
  {
    return $this->hasMany('Casa\Vinculo', 'adotante_id');
  }

  public function observacoes() 
  {
    return $this->belongsToMany(Adotivo::class, 'adotantes_adotivos')
    ->withPivot('observacoes')
    ->orderBy('id', 'desc')
    ->get()->first()
    ->pivot->observacoes;
  }
}
