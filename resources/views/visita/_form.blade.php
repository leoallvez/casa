<div class="row">
    <div class="col-md-6">
        {!! Form::label('adotante_id', 'Adotante') !!}
        @if(isset($visita))
            {!! Form::text('adotante_id', $visita->adotante['nome'], ['class' => 'form-control',' readonly']) !!}
        @else
            {!! Form::select(
                    'adotante_id', 
                    $adotantes, 
                    $visita->adotante_id ?? null,
                    [   
                        'id' => 'segmentos', 
                        'class' => 'form-control',
                        'placeholder' => 'Selecione'
                    ]
                ) 
            !!}
        @endif
    </div>
    <div class="col-md-6">
        {!! Form::label('adotivo_id', 'Adotivo') !!}

        @if(isset($visita))
            {!! Form::text('adotivo_id', $visita->adotivo['nome'], ['class' => 'form-control',' readonly']) !!}
        @else
            {!! Form::select(
                    'adotivo_id', 
                    $adotivos, 
                    $visita->adotivo_id ?? null,
                    [   'id' => 'segmentos', 
                        'class' => 'form-control',
                        'placeholder' => 'Selecione'
                    ]
                ) 
            !!}
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        {!! Form::label('dia', 'Dia')!!}
        {!! Form::date('dia', null, ['class' => 'form-control', 'placeholder' => 'Dia da visita'])!!}
    </div>
    <div class="col-md-2">
        {!! Form::label('hora', 'Horas')!!}
        {!! Form::select(
                'hora', 
                [
                    '08'  => '08', 
                    '09'  => '09', 
                    '10'  => '10', 
                    '11'  => '11', 
                    '12'  => '12', 
                    '13'  => '13', 
                    '14'  => '14', 
                    '15'  => '15', 
                    '16'  => '16', 
                    '17'  => '17', 
                    '18'  => '18', 
                    '19'  => '19'
                ], 
                $visita->hora ?? null,
                ['class' => 'form-control']
            )
        !!}
    </div>
    <div class="col-md-2">
        {!! Form::label('minuto', 'Minutos') !!}
        {!! Form::select(
                'minuto', 
                [
                    '00' => '00', 
                    '05' => '05', 
                    '10' => '10', 
                    '15' => '15', 
                    '20' => '20', 
                    '25' => '25', 
                    '30' => '30', 
                    '35' => '35', 
                    '40' => '40', 
                    '45' => '45', 
                    '50' => '50', 
                    '55' => '55'

                ], 
                $visita->minuto ?? null,
                ['class' => 'form-control']
            )
        !!}
    </div>
    <div class="col-md-2">
        <span class="smallTitle">
            {!! Form::label('tempo_estimado', 'Tempo Estimado') !!}
        </span>
        {!! Form::select(
                'tempo_estimado', 
                [
                    '00:30' => '00:30', 
                    '01:00' => '01:00', 
                    '01:30' => '01:30', 
                    '02:00' => '02:00', 
                    '02:30' => '02:30', 
                    '03:00' => '03:00', 
                    '03:30' => '03:30',
                    '04:00' => '04:00',
                    '04:30' => '04:30', 
                    '05:00' => '05:00', 
                    '05:30' => '05:30', 
                    '06:00' => '06:00', 
                    '06:00' => '06:30'
                ], 
                $visita->minuto ?? null,
                ['class' => 'form-control']
            )
        !!}
    </div>
</div>


<br>

<div class="form-group">
    {{ Html::linkAction('VisitaController@index','Voltar', array(), array('class' => 'btn btn-warning')) }}
    {!! Form::submit($nomeBotaoSubmit, ['class' => 'btn btn-primary']) !!}
</div>
