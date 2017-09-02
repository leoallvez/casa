<?php

namespace Casa;
use Casa\Visita;
use Casa\Adotante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model {

    public $timestamps = false;

    public function __construct(array $attributes = array()) 
    {
        parent::__construct($attributes);
        $this->usuario_id = Auth::id() ?? 1;
        $this->instituicao_id = Auth::user()->instituicao_id ?? 1;
    }

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

            #TODO: bug agendando visitas para os adotantes antigo do adotivo
            
            $vinculos = Vinculo::whereIn('adotivo_id', $adotivos)->where("deleted_at", null)->get();
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

                $agenda->getVisitasVinculos();

                $visitas = $agenda->visitas->first();
                $nome_adotivo = Adotivo::getNomeAbreviadoByVinculoId($visitas->vinculo_id);

                $results[] = [
                    "id"          => $agenda->id,
                    "title"       => $nome_adotivo,
                    "description" => $nome_adotivo,
                    "color"       => '#3498DB',
                    "date"        => $agenda->getDiaEHorario(),
                    "hora_inicio" => $agenda->hora_inicio,
                    "hora_fim"    => $agenda->hora_fim,
                    "status"      => $agenda->status,
                    "dia"         => $agenda->formatarData(),
                    "adotante_id" => $agenda->getAdotanteId(),
                    "adotivo_id"  => $agenda->getVisitasVinculos(),
                ];
            }
        }
        return response()->json($results);
    }

    /**
     * formarta data de yyyy-mm-dd para dd/mm/yyyy
     */
    private function formatarData() : string {
        $timestamp = strtotime($this->dia); 
        return date('d/m/Y', $timestamp);
    }

    private function getAdotanteId() {
        $visita = $this->visitas->first();
        $vinculo = Vinculo::find($visita->vinculo_id);
        return $vinculo->adotante->id;
    }
    /**
     * Pega o(s) vinculo(s) da(s) visitas(s).
     */
    private function getVisitasVinculos() : array {
        return $this->visitas()->pluck('vinculo_id')->toArray(); 
    }

    private function getDiaEHorario() : string {
        return $this->dia." ".$this->hora_inicio;
    }
}
