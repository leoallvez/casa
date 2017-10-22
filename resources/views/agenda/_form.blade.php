
{{ Form::hidden('is_registada', true) }}

<div class="row">
    <div class="col-md-12 col-xs-12 form-group">
        {!! Form::label('adotante_nome', 'Adotante') !!}
        {!! Form::text('adotante_nome', $visita->getAdotanteNome(), 
            [
                'class' => 'form-control', 
                'disabled',
            ]) 
        !!}
    </div>
</div>

@if(!is_null($visita->getAdotanteConjugeNome()))
    <div class="row">
        <div class="col-md-12 col-xs-12 form-group">
            {!! Form::label('adotante_conjuge_nome', 'Conjuge') !!}
            {!! Form::text('adotante_conjuge_nome', $visita->getAdotanteConjugeNome(), 
                [
                    'class' => 'form-control', 
                    'disabled',
                ]) 
            !!}
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-12 col-xs-12 form-group">
        {!! Form::label('adotante_nome', 'Adotivo') !!}
        {!! Form::text('adotivo_nome', $visita->getAdotivoNome(), 
            [
                'class' => 'form-control', 
                'disabled',
            ]) 
        !!}
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-2">
            {!! Form::label('dia', 'Data') !!}
            {!! Form::text('dia', $agenda->formatarData(),
                [
                    'class' => 'form-control',
                    'disabled',
                ])
            !!}
        </div>

        <div class="col-md-2">
            {!! Form::label('hora_inicio', 'Hora Inicial') !!}
            {!! Form::time('hora_inicio', $agenda->hora_inicio,
                [
                    'class' => 'form-control',
                    'disabled',
                ])
            !!}
        </div>

        <div class="col-md-2">
            {!! Form::label('hora_fim', 'Hora Final') !!}
            {!! Form::time('hora_fim', $agenda->hora_fim,
                [
                    'class' => 'form-control',
                    'disabled',
                ])
            !!}
        </div>

        <div class="col-md-2">
            {!! Form::label('tempo_total', 'Tempo Total') !!}
            {!! Form::text('tempo_total', $agenda->calcularTempoTotal(),
                [
                    'class' => 'form-control',
                    'disabled',
                ])
            !!}
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            {!! Form::label('opiniao_adotante', 'Opinião do Adotante(s)')!!}
            {!! Form::textarea('opiniao_adotante',
                null,
                [
                    'class' => 'form-control',
                ])
            !!}
            <a>
                <span class='validacao-text'>
                    {{ $errors->first('opiniao_adotante') }}
                </span>
            </a>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            {!! Form::label('opiniao_adotivo', 'Opinião do Adotivo')!!}
            {!! Form::textarea('opiniao_adotivo',
                null,
                [
                    'class' => 'form-control',
                ])
            !!}
            <a>
                <span class='validacao-text'>
                    {{ $errors->first('opiniao_adotivo') }}
                </span>
            </a>
        </div>
    </div>
</div>

<br>
<div class="form-group">
    {!! Html::linkAction('AgendaController@registrarListar','Voltar', null, ['class' => 'btn btn-primary']) !!}
    {!! Form::submit($nomeBotaoSubmit, ['class' => 'btn btn-success']) !!}
</div>

