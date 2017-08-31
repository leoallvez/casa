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
            $vinculos = $adotante->adotivos;

            foreach($vinculos as $vinculo) {
                $visita = new Visita;
                $visita->vinculo()->associate($vinculo);
                $visita->agenda()->associate($this)->save();
            }
            return true;
        }
        return false;
    }

    public static function listar() 
    {
        //$results = [];
        $agendas = self::where('instituicao_id', Auth::user()->instituicao_id)->get();
        
        if(!is_null($agendas)) {
    
            foreach($agendas as $agenda) {
                
                $results[] = [
                    "id"          => $agenda->id,
                    "title"       => 'Teste 1',
                    "description" => 'Teste 2',
                    "color"       => $agenda->getCorDoStatus(),
                    "date"        => $agenda->getDiaEHorario(),
                ];
            }
        }
        return response()->json($results);
    }

    private function getCorDoStatus() : string {
        switch($this->status) {
            case 'agendado':
                $cor = '#27AE60';
                break;
            case 'reagendado':
                $cor = '#FFC300';
                break;
            case 'cancelado':
                $cor = '#FF5733';
                break;
        }
        return $cor;
    }

    private function getDiaEHorario() : string {
        return $this->dia." ".$this->hora_inicio;
    }
}
