<?php
namespace Casa;

use Carbon\Carbon;
use Casa\AdotivoStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class Adotivo extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'nascimento',
        'data_chegada'
    ];

    protected $fillable = [
      'nome',
      'sexo',
      'etnia_id',
      'status_id',
      'matricula',
      'created_at',
      'updated_at',
      'nascimento',
      'usuario_id',
      'restricao_id',
      'data_chegada',
      'instituicao_id',
      'escolaridade_id',
      'nacionalidade_id',
    ];

    /**
     * Retorna um array contendo outro array com nome do status e
     * a quantidade de adotivo nesse status.
     * @return array of array
     */
    public static function getQuantidadePorStatus() : array
    {
        $dados = []; 
        $status = AdotivoStatus::all();

        foreach ($status as $s) {
            $resultado = DB::table('adotivos')
            ->join('adotivos_status', 'adotivos.status_id', '=', 'adotivos_status.id')
            ->select('adotivos_status.nome', DB::raw('count(adotivos.status_id) as quantidade'))
            ->where('adotivos_status.id', '=', $s->id)
            ->groupBy('adotivos_status.nome')
            ->first();

            if(isset($resultado)) {
                $dados[] = [$s->nome, intval($resultado->quantidade)];
            }else{
                $dados[] = [$s->nome, 0];
            }
        }
        return $dados;
    }

    /**
     * 
     * @return void
     */
    public function setStatus(int $status_id) : void
    {
        $this->status_id = $status_id;
    }

    /**
     * 
     * @return void
     */
    public function setInstituicao(int $id) : void
    {
        $this->instituicao_id = $id;
    }

    /**
     * 
     * @return void
     */
    public function setUsuario(int $id) : void
    {
            $this->usuario_id = $id;
    }

    /**
     * Esse metodo retornar uma String com a idade de um adotivo.
     * @return string
     */
    public function calcularIdade() : string
    {
        $anos    = $this->nascimento->diffInYears(Carbon::now());
        $meses   = $this->nascimento->diffInMonths(Carbon::now());
        $semanas = $this->nascimento->diffInWeeks(Carbon::now());
        $dias    = $this->nascimento->diffInDays(Carbon::now());

        $idade = '';

        if( $anos > 0 && $anos > 1)
            $idade .= $anos.' anos ';
        else if($anos == 1 )
            $idade .= ' 1 ano ';

        if($meses > 0 && $meses < 13 && $meses > 1)
            $idade .= $meses.' meses ';
        else if($meses == 1 )
            $idade .= ' 1 mês';

        if($semanas > 0 && $semanas < 4 && $semanas > 1)
            $idade .= $semanas.' semanas ';
        else if($semanas == 1)
            $idade .= '1 semana ';

        if($dias > 0 && $dias < 7 && $dias > 1)
            $idade .= $dias.' dias';
        else if($dias == 1)
            $idade .= ' 1 dia';

        return $idade;
    }
    
    /**
     * Caso o adotivo, adotante e conjuge tenham uma diferença maior que 16 anos
     * retorna true, caso contrario false.
     * @return boolean
     */
    public function tem16AnosDeDiferenca(Adotante $adotante) : bool
    {
        $adotante_difference = $this->nascimento->diffInYears($adotante->nascimento);
        # Adotante pode não ter conjuge.
        if(!is_null($adotante->conjuge_nascimento)) {
            $conjuge_difference  = $this->nascimento->diffInYears($adotante->conjuge_nascimento);
            return $adotante_difference >= 16 && $conjuge_difference >= 16;
        }
        return $adotante_difference >= 16;
    }

    /**
     * @return string
     */
    public function getSexo() : string
    {
        return ($this->sexo == 'M') ? 'Masculino' : 'Feminino';
    }

    /**
     * @return array
     */

    public function getIrmaosIds() : array
    {
       return  $this->irmaos()->getRelatedIds()->toArray();
    }

    /**
     * @return void
     */
    public function salvarIrmaos($irmaosIds = []) : void
    {
        if(isset($irmaosIds)) {

            $irmaos = Adotivo::whereIn('id',$irmaosIds)->get();

            foreach($irmaos as $irmao) {
                $irmao->irmaos()->sync([$this->id]);
            }
            $this->irmaos()->sync($irmaosIds);
        } else {
            $this->irmaos()->sync([]);
        }
    }

    /**
     * @return void
     */
    public function atualizarIrmaos($irmaosIds) : void
    {
        if(isset($irmaosIds)) {
            $this->removerVinculoNosIrmaos($irmaosIds);
            $this->realizarVinculoNosIrmaos($irmaosIds);
            $this->irmaos()->sync($irmaosIds);
        } else {
            $this->removerVinculoNosIrmaos();
            $this->irmaos()->sync([]);
        }
    }

    /**
     * Realiza o vinculos do adotivo em seu(s) irmão(s)
     * que tem o id no array.
     * Caso já exista o vinculo não o modifica.
     * @return void
     */
    private function realizarVinculoNosIrmaos(array $irmaosIds) : void
    {
        $irmaos = Adotivo::whereIn('id',$irmaosIds)->get();
        foreach($irmaos as $irmao) {
            $irmao->irmaos()->sync([$this->id]);
        }
    }
    /**
     * Remove o vinculos do adotivo em seu(s) irmão(s)
     * estão na base mas que não que tem o id no array.
     * Caso o array seja vazio remove todo os vinculos
     * os irmãos na qual tem o adotivo.
     * @return void
    */
    private function removerVinculoNosIrmaos(array $irmaosIds = []) : void
    {
        if(count($irmaosIds) > 0) {
            # Pegar todos irmãos que não tem seu id no array
            $Irmaos= $this->irmaos()->where('irmaos.id','<>', $irmaosIds)->get();
        }else {
            $Irmaos= $this->irmaos()->get();    
        }
        # Desfazer o(s) vinculo(s).
        foreach($Irmaos as $irmao) {
            $irmao->irmaos()->detach($this->id);
        }
    }

    /**
     * @return boolean
     */
    public function temAdotantes() : bool
    {
       $result = $this->adotantes()
       ->where('adotantes_adotivos.deleted_at', '=', null)
       ->get();

       return count($result) > 0;
    }

    /**
     * @return string
     */
    public static function gerarMatricula() : string
    {
        $last_id = self::all()->last()->id;

        return ($last_id)? str_pad($last_id + 1 , 12, "CASA-00000000", STR_PAD_LEFT) : "CASA-00000001";
    }

    /**
     * @return string
     */
    public static function getNomeAbreviadoByVinculoId(int $vinculo_id) : string 
    {
        $nomeAbreviado = ""; 

        $vinculo = Vinculo::where('id', $vinculo_id)->first();

        if(!is_null($vinculo)) {
            # trim() retirar espaços em branco no começo e fim.
            #str_split() transforma o array em uma string.
            $nomeArray = str_split(trim($vinculo->adotivo->nome));
        
            for($i = 0; $i < count($nomeArray); $i++) {
                $nomeAbreviado .= $nomeArray[$i];

                if($nomeArray[$i] == " ") {
                    $nomeAbreviado .= $nomeArray[$i+1];
                    break;
                }
            }
            return strtoupper($nomeAbreviado.".");
        }
        return $nomeAbreviado;
    }

    public function buscar($valor_de_busca) 
    {
        return self::where('nome', 'like', '%'.$valor_de_busca.'%')
        ->where('instituicao_id', Auth::user()->instituicao_id)
        ->orderBy('nome')
        ->paginate(config('app.list_size'));
    }

    public function getIdadeAsInt() : int
    {
        return $this->nascimento->diffInYears(Carbon::now());
    }

   /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function adotantes() 
    {
    	return $this->belongsToMany('Casa\Adotante', 'adotantes_adotivos')
        ->withPivot('created_at', 'deleted_at');
    }

    public function status() 
    {
        return $this->belongsTo('Casa\AdotivoStatus', 'status_id');
    }

    public function etnia()
    {
        return $this->belongsTo('Casa\Etnia');
    }

    public function nacionalidade()
    {
        return $this->belongsTo('Casa\Nacionalidade');
    }

    public function instituicao() 
    {
        return $this->belongsTo('Casa\Instituicao');
    }

    public function visitas() 
    {
        return $this->hasMany('Casa\Visita', 'adotivo_id');
    }

    public function restricao() 
    {
        return $this->hasOne(
            'Casa\Restricao',
            'id',
            'restricao_id'
        );
    }

    public function irmaos() 
    {
        return $this->belongsToMany(
            'Casa\Adotivo',
            'irmaos',
            'adotivo_id',
            'irmao_id'
        );
    }
}
