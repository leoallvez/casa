<?php
namespace Casa;

use Carbon\Carbon;
use Casa\AdotivoStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adotivo extends Model{
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
        'nascimento',
        'usuario_id',
        'restricao_id',
        'data_chegada',
        'instituicao_id',
        'escolaridade_id',
        'nascionalidade_id'
    ];
    /**
     * Retorna um array contendo outro array com nome do status e
     * a quantidade de adotivo nesse status. 
     * @return array of array
     */
    public static function getQuantidadePorStatus() {
        $status = AdotivoStatus::all();

        foreach ($status as $s) {
            $resultado = DB::table('adotivos')
            ->join('adotivos_status', 'adotivos.status_id', '=', 'adotivos_status.id')
            ->select('adotivos_status.nome', DB::raw('count(adotivos.status_id) as quantidade'))
            ->where('adotivos_status.id', '=', $s->id)
            ->groupBy('adotivos_status.nome')
            ->first();
    
            if(isset($resultado)){
                $dados[] = [$s->nome, intval($resultado->quantidade)];
            }else{
                $dados[] = [$s->nome, 0];
            }
        }
        return $dados;
    }
    public function setStatus(int $status_id) {
        $this->status_id = $status_id;  
    }
    public function setInstituicao(int $id) {
        $this->instituicao_id = $id;
    }
   
   public function setUsuario(int $id) {
        $this->usuario_id = $id; 
   }

    /**
     * Esse metodo retorna uma String com a idade de um adotant
     * @return string
     */
    public function CalcularIdade() {
        $anos = $this->nascimento->diffInYears(Carbon::now());
        $meses = $this->nascimento->diffInMonths(Carbon::now());
        $semanas = $this->nascimento->diffInWeeks(Carbon::now());
        $dias = $this->nascimento->diffInDays(Carbon::now());

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
        else if ($semanas == 1)
            $idade .= '1 semana ';

        if($dias > 0 && $dias < 7 && $dias > 1)
            $idade .= $dias.' dias'; 
        else if ($dias == 1)
            $idade .= ' 1 dia'; 

        return $idade;
    }

    public function getSexo() {
        return ($this->sexo == 'M')? 'Masculino' : 'Feminino';
    }

    public function hasAdotantes() {
    
       $result = $this->adotantes()->where('adotantes_adotivos.deleted_at', '=', null)->get();
       // dd($result);
       return count($result) > 0;
    }

    public function adotantes() {
    	return $this->belongsToMany('Casa\Adotante', 'adotantes_adotivos')
        ->withPivot('created_at', 'deleted_at');
    }

    public function status() {
        return $this->belongsTo('Casa\AdotivoStatus', 'status_id');
    }

    public function etnia() {
        return $this->belongsTo('Casa\Etnia');
    }

    public function nascionalidade() {
        return $this->belongsTo('Casa\Nascionalidade');
    }

    public function instituicao() {
        return $this->belongsTo('Casa\Instituicao');
    }

    public function visitas() {
        return $this->hasMany('Casa\Visita', 'adotivo_id');
    }

    public function restricao(){
        return $this->hasOne('Casa\Restricao', 'id', 'restricao_id');
    }

    public function irmaos() {
        // return $this->belongsToMany('Casa\Irmao');
        return $this->belongsToMany('Casa\Adotantes','irmaos','adotivo_id', 'irmao_id');
    }
}
