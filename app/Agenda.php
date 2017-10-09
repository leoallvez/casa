<?php

namespace Casa;
use Casa\Visita;
use Casa\Adotante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class Agenda extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    const AGENDADA   = "agendada";
    const REAGENDADA = "reagendada";
    const CANCELADA  = "cancelada";

    public function __construct(array $attributes = array()) 
    {
        if(count($attributes) > 0) {
            $attributes['status'] = Agenda::AGENDADA;
            $attributes['observacoes'] = null;
        }
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

    /**
    * @return boolean
    */
    public function agendarVisita(int $adotante_id) : bool
    {
        $adotante = Adotante::find($adotante_id);

        $temVisitaNoDia = $this->adotanteTemVisitaNoDia($adotante_id);

        if(!$temVisitaNoDia) {
            
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

    /**
    * @return boolean
    */
    public function reagendarVisita(array $atributos) : bool 
    {
        $temVisitaNoDia = $this->adotanteTemVisitaNoDia(null, $atributos['dia']);

        if(!$temVisitaNoDia) {
            
            $this->observacoes = $atributos['observacoes'];
            $this->status = Agenda::REAGENDADA;
            $this->save();
            $this->delete();

            $novaAgenda = new self($atributos);
            $novaAgenda->agendarVisita($this->getAdotanteId());
            
            return true;
        }
        return false;
    }

    /**
    * @return void
    */
    public function cancelarVisita(string $observacoes) : bool
    {
        if(!is_null($observacoes)) {
            $this->status = Agenda::CANCELADA;
            $this->save();
            $this->delete();
            return true;
        }
        return false;
    }

    /**
    * @return boolean
    */
    public function adotanteTemVisitaNoDia(int $adotante_id = null , string $data = null) : bool 
    {

        $data = (is_null($data)) ? $this->dia : $data;

        $adotante_id = (is_null($adotante_id)) ? $this->getAdotanteId() : $adotante_id;

        $adotante = Adotante::find($adotante_id);

        $vinculos = $adotante->vinculos()->where('deleted_at', null)->get();

        foreach($vinculos as $vinculo) {

            $visitas = $vinculo->visitas;

            if(!is_null($visitas)) {

                foreach($visitas as $visita) {

                    $agenda = self::where('id', $visita->agenda_id)->first();

                    if(!is_null($agenda)) {

                        if($agenda->dia == $data) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    /**
    * @return array
    */
    public static function listar() : array 
    {
        $results = [];
        $agendas = self::where('instituicao_id', Auth::user()->instituicao_id ?? 2)->get();
        
        if(!is_null($agendas)) {

            foreach($agendas as $agenda) {

                $agenda->getVisitasVinculos();

                $visitas = $agenda->visitas->first();
                $nome_adotivo = Adotivo::getNomeAbreviadoByVinculoId($visitas->vinculo_id);

                $results[] = [
                    "id"            => $agenda->id,
                    "title"         => $nome_adotivo,
                    "description"   => $nome_adotivo,
                    "color"         => '#3498DB',
                    "date"          => $agenda->getDiaEHorario(),
                    "hora_inicio"   => $agenda->hora_inicio,
                    "hora_fim"      => $agenda->hora_fim,
                    "status"        => $agenda->status,
                    "dia_formatado" => $agenda->formatarData(),
                    "dia_base"      => $agenda->dia,
                    "adotante_id"   => $agenda->getAdotanteId(),
                    "adotivo_id"    => $agenda->getVisitasVinculos(),
                ];
            }
        }
        return $results;
    }

    /**
    * Formarta data de yyyy-mm-dd para dd/mm/yyyy
    * @return string
    */
    private function formatarData() : string {
        $timestamp = strtotime($this->dia); 
        return date('d/m/Y', $timestamp);
    }

    /**
    * @return int
    */
    public function getAdotanteId() : int {
        $visita = $this->visitas->first();
        $vinculo = Vinculo::find($visita->vinculo_id);
        return $vinculo->adotante->id;
    }

    /**
    * [description]
    * Pega o(s) vinculo(s) da(s) visitas(s).
    * @return array
    */
    private function getVisitasVinculos() : array {
        return $this->visitas()->pluck('vinculo_id')->toArray(); 
    }

    /**
    * @return string
    */
    private function getDiaEHorario() : string {
        return $this->dia." ".$this->hora_inicio;
    }

    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function visitas()
    {
        return $this->hasMany('Casa\Visita');
    }
}
