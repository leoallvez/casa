
@php($hasConjuge = $adotante->hasConjuge())

<div class="row">
    <div class="col-md-12 col-xs-12 form-group">
        {!! Form::label('adotante', 'Adotante') !!}
        {!! Form::text('adotante', $adotante->nome,
            [
                'class' => 'form-control myclass ',
                'disabled'
            ])
        !!}
    </div>
</div>
@if($hasConjuge)
    <div class="row">
        <div class="col-md-12 col-xs-12 form-group">
            {!! Form::label('conjuge', 'Conjuge') !!}
            {!! Form::text('conjuge', $adotante->conjuge_nome,
                [
                    'class' => 'form-control myclass ',
                    'disabled'
                ])
            !!}
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-2 col-xs-12">
        <div class="form-group">
            {!! Form::label('input-inicio', 'Data Inicial')!!}
            {!! Form::text('input-inicio',
                date('d/m/Y',strtotime( $adotante->pivot->created_at )) ,
                [
                    'class'       => 'form-control',
                    'data-mask'   => '99/99/9999',
                    'placeholder' => '00/00/0000',
                    'id'          => 'input-inicio',
                    'disabled'
                ])
            !!}
        </div>
    </div>
    <div class="col-md-2 col-xs-12">
        <div class="form-group">
            {!! Form::label('input-final', 'Data Final')!!}
            {!! Form::text('input-final',
                date('d/m/Y',strtotime( $adotante->pivot->deleted_at )),
                [
                    'class'       => 'form-control',
                    'data-mask'   => '99/99/9999',
                    'placeholder' => '00/00/0000',
                    'id'          => 'input-final',
                    'disabled'
                ])
            !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            {!! Form::label('input-observacao', 'Observação')!!}
            {!! Form::textarea('input-observacao',
                $adotante->observacoes(),
                [
                    'class' => 'form-control',
                    "style" => 'background-color: #90CAF9; font-weight: bold; border: 1px solid #1976D2;',
                    'disabled'
                ])
            !!}
        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Visitas</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content collapse">
            <ul class="list-unstyled timeline">
                @if(!$visitas->isEmpty())
                    @foreach($visitas as $visita)
                        <li>
                            <div class="block">
                                <div class="byline">
                                    <h4>
                                        <span>
                                            Das<b> {{ substr($visita->agenda->hora_inicio, 0, 5) }} </b> às 
                                            <b> {{ substr($visita->agenda->hora_fim, 0, 5) }}</b>, tempo total 
                                            <b>{{ $visita->agenda->calcularTempoTotal() }}</b>.
                                        </span>
                                    </h4>
                                </div><br>
                                <div class="tags">
                                    <a href="" class="tag">
                                        <span><b>{{ $visita->agenda->formatarData() }}</b></span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        @if($hasConjuge)
                                            <a>Opinião Adotantes</a>
                                        @else
                                            <a>Opinião Adotante</a>
                                        @endif
                                    </h2><br>
                                    <p class="excerpt">
                                        {{ $visita->opiniao_adotante }}
                                    </p>
                                </div>
                            </div>
                            <div class="block">
                                <div class="tags">
                                    <a href="" class="tag">
                                        <span><b>{{ $visita->agenda->formatarData() }}</b></span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a>Opinião Adotivo</a>
                                    </h2><br>
                                    <p class="excerpt">
                                        {{ $visita->opiniao_adotivo }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <p>Nenhuma visita registrada para esse vínculo.</p>
                @endif
            </ul>    
        </div>
    </div>
</div>

<div class="form-group">
    <a href="{{ route('listar', $adotivo->id) }}" class='btn btn-primary'>Voltar</a>
</div>