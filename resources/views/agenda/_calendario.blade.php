<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
                <div id='calendar'></div>
        </div>
    </div>
</div>

<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">
                    Close
                    </span>
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="error"></div>
                <form id="crud-form">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::label('adotante_id', 'Adotante(s)') !!}
                                {!! Form::select(
                                    'adotante_id',
                                    $adotantes,
                                    null,
                                    [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Selecione Adotante(s)',
                                        'style'    => 'width: 100%',
                                        'onchange'    => 'buscarAdotivos(); clearErros();',
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::label('adotivo_id', 'Adotivo(s)') !!}<br>
                                {!! Form::select(
                                    'adotivo_id',
                                    $adotivos,
                                    null,
                                    [
                                        'class'    => 'form-control',
                                        'multiple' => 'multiple',
                                        'style'    => 'width: 100%',
                                        'disabled'
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('display_data', 'Data') !!}
                                {!! Form::text('display_data', null,
                                    [
                                        'class'       => 'form-control',
                                        'data-mask'   => '99/99/9999',
                                        'placeholder' => '00/00/0000',
                                        'id'          => 'display_data',
                                        'onchange'    => 'converterDataParaBase()',
                                        'disabled'
                                    ])
                                !!}
                                {!! Form::hidden('dia', null,
                                        [
                                            'class' => 'form-control',
                                            'id'    => 'hidden_data'
                                        ]
                                    )
                                !!}
                            </div>

                            <div class="col-md-3">
                                {!! Form::label('hora_inicio', 'Hora Inicial') !!}
                                {!! Form::time('hora_inicio', null,
                                    [
                                        'class'    => 'form-control',
                                        'onchange' => "calcularTempoTotal(); 
                                        validarHorarios(this); 
                                        validarHorarioDeVisita(this, '$instituicao->hora_inicio_visita' , '$instituicao->hora_fim_visita');
                                        visitaTemMeiaHoraOuMais(this);",
                                    ])
                                !!}
                            </div>

                            <div class="col-md-3">
                                {!! Form::label('hora_fim', 'Hora Final') !!}
                                {!! Form::time('hora_fim', null,
                                    [
                                        'class'    => 'form-control',
                                        'onchange' => "calcularTempoTotal(); 
                                        validarHorarios(this); 
                                        validarHorarioDeVisita(this, '$instituicao->hora_inicio_visita' , '$instituicao->hora_fim_visita');
                                        visitaTemMeiaHoraOuMais(this);",
                                    ])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::label('tempo_total', 'Tempo Total') !!}
                                {!! Form::text('tempo_total', '--:--',
                                    [
                                        'id'       => 'tempo_total',
                                        'class'    => 'form-control',
                                        'disabled',
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>
                    <div id="observacoes_div" style="display:none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::label('observacoes', 'Motivo') !!}
                                    {!! Form::textarea('observacoes', null,
                                        [
                                            'class' => 'form-control',
                                        ])
                                    !!}
                                </div>
                            </div>
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Voltar
                </button>
            </div>
        </div>
    </div>
</div>

@section('style')
    <link href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print'/>
    <link href="{{ asset('css/fullcalendar/casa-fullcallendar.css') }}" rel="stylesheet" />
@endsection

@section('calendar-js')
    {{--FullCalendar--}}
    <script src="{{ asset('js/fullcalendar/bootstrapValidator.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/pt-br.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/bootstrap-timepicker.min.js') }}"></script>

    <script type="text/javascript">
        var url_base = "{{ url('/') }}";
    </script>
    <script src="{{ asset('js/casa/dev/calendario-visitas.js') }}"></script>
@endsection