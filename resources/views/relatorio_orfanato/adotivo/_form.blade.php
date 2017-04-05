<div class="row">
    <div class="col-md-9">
        {!! Form::label('nome', 'Nome') !!}
        <span class='red'>*</span>
        {!! Form::text('nome', null, 
            [
                'class'       => 'form-control', 
                'placeholder' => 'Nome Completo do Adotivo'
            ]) 
        !!}
        <span class='validacao-text'> 
            {{ $errors->first('nome') }}
        </span>
    </div>
    <div class="col-md-3">
        <p>
            {!! Form::label('sexo', 'Sexo') !!}<br>
            Masculino:
            {!! Form::radio('sexo', 'M', true, ['class' => 'flat']) !!}
            Feminino:
            {!! Form::radio('sexo', 'F', null, ['class' => 'flat']) !!}
        </p>
    </div>  
</div><br>

<div class="row">
    <div class="col-md-3">
        {!! Form::label('input-nascimento', 'Nascimento')!!}
        <span class='red'>*</span>
        {!! Form::text('input-nascimento', 
            (isset($adotivo)) ? $adotivo->nascimento->formatLocalized('%d/%m/%Y') : null, 
            [   
                'class'       => 'form-control', 
                'data-mask'   => '99/99/9999',
                'placeholder' => '00/00/0000',
                'id'          => 'input-nascimento',
                'onchange'    => "converteData('#input-nascimento', '#hidden_nascimento')"
            ]) 
        !!}
        {!!
            Form::hidden('nascimento',
                $adotante->nascimento ?? null,
                [
                    'class' => 'form-control',
                    'id'    => 'hidden_nascimento'
                ]
            )
        !!}
        <span class='validacao-text'> 
            {{ $errors->first('nascimento') }}
        </span>
        
    </div>

    <div class="col-md-3">
        {!! Form::label('input-chegada', 'Data de Chegada')!!}
        <span class='red'>*</span>
        {!! Form::text('input-chegada', 
            (isset($adotivo)) ? $adotivo->data_chegada->formatLocalized('%d/%m/%Y') : null, 
            [   
                'class'       => 'form-control', 
                'data-mask'   => '99/99/9999',
                'placeholder' => '00/00/0000',
                'id'          => 'input-chegada',
                'onchange'    => "converteData('#input-chegada', '#hidden_data_chegada')"
            ]) 
        !!}
        {!!
            Form::hidden('data_chegada',
                $adotante->data_chegada ?? null,
                [
                    'class'       => 'form-control',
                    'id'          => 'hidden_data_chegada',
                    'placeholder' => 'Data de Chegada na Instiuição'
                ]
            )
        !!}
        <span class='validacao-text'> 
            {{ $errors->first('data_chegada') }}
        </span>
    </div>

    <div class="col-md-3">
        {!! Form::label('status_id', 'Status') !!}
        {!! Form::select(
            'status_id', 
            $opcoes['status'], 
            $adotivo->status->id ?? null, 
            [
                'class' => 'form-control'
            ])
        !!}
    </div>

    <div class="col-md-3">
        {!! Form::label('etnia_id', 'Etnia') !!}
        {!! Form::select(
            'etnia_id', 
            $opcoes['etnias'], 
            $adotivo->etnia->id ?? null, 
            [
                'class' => 'form-control'
            ])
        !!}
    </div>
</div><br>

@if(isset($adotantesNoProcesso))
    <div class="row">
        <div class="col-md-12">
            {!! Form::label(null ,'Adotante(s)') !!}<br>
            {!! Form::select(
                    'adotantes[]', 
                    $adotantes, 
                    $adotantesNoProcesso ?? null,
                    [   
                        'class'    => 'form-control',
                        'id'       => 'adotantes',
                        'multiple' => 'multiple',
                        'disabled'
                    ]
                ) 
            !!}
        </div>
    </div>
@endif
<br>

<div class="form-group">
    {!! Html::linkAction('AdotivoController@index','Voltar', null, ['class' => 'btn btn-primary']) !!}
    {!! Form::submit($nomeBotaoSubmit, ['class' => 'btn btn-success']) !!}
</div>

@section('js')
    <script type="text/javascript">
        function converteData(input, hidden) {
            var date = $(input).val(); 
            date = date.split("/").reverse().join("-");
            $(hidden).val(date);  
        }
      
        $(document).ready(function() {
         
          $("#adotantes").select2({
            placeholder: "Selecione adotantes(s)",

            language: {
                noResults: function() {
                    return "Adotante não encontrado!";
                }
            }
          });
        });
    </script>
@endsection
