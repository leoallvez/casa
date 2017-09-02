<?php

namespace Casa;
use Casa\Visita;
use Casa\Adotante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model {

    public $timestamps = false;
    //protected $table = 'events';

    public function __construct(array $attributes = array()) 
    {
        parent::__construct($attributes);
        $this->usuario_id = Auth::id() ?? 1;
        $this->instituicao_id = Auth::user()->instituicao_id ?? 1;
    }

    // protected $fillable = [
    //     'title',
    //     'color',
    //     'date',
    //     'description',
    // ];

    protected $fillable = [
        'dia',
        'hora_inicio',
        'hora_fim',
        'status',
        'opiniao_adotantes',
        'opiniao_adotivos',
        'observacoes',
    ];

    public function visitas()
    {
        return $this->hasMany('Casa\Visita');
    }

    public function agendarVisita(int $adotante_id) 
    {
        $adotante = Adotante::find($adotante_id);

        if(!is_null($adotante)) {
            
            $this->save();
            $adotivos = $adotante->adotivos->pluck('id');
            
            $vinculos = Vinculo::whereIn('adotivo_id', $adotivos)->get();
            //$vinculos = $adotante->adotivos;
            foreach($vinculos as $vinculo) {
                $visita = new Visita;
                $visita->vinculo()->associate($vinculo);
                $visita->agenda()->associate($this);
                $visita->save();
            }
            return true;
        }
        return false;
    }

    public static function listar() 
    {
        $results = [];
        $agendas = self::where('instituicao_id', Auth::user()->instituicao_id)->get();
        
        if(!is_null($agendas)) {

            foreach($agendas as $agenda) {

                $visitas = $agenda->visitas->first();
                $nome_adotivo = Adotivo::getNomeAbreviadoByVinculoId($visitas->vinculo_id);

                $results[] = [
                    "id"          => $agenda->id,
                    "title"       => $nome_adotivo,
                    "description" => $nome_adotivo,
                    "color"       => '#3498DB',
                    "date"        => $agenda->getDiaEHorario(),
                ];
            }
        }
        return response()->json($results);
    }

    private function getDiaEHorario() : string {
        return $this->dia." ".$this->hora_inicio;
    }
}
