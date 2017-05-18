<link href="{{ asset('assets/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet" />

<div class="row">
    <div class="col-md-9">
        {!! Form::label('nome', 'Nome') !!}
        <span class='obrigatorio'>*</span>
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
        {!! Form::label('sexo', 'Sexo') !!}<br>
        <strong> Masculino: </strong>
        {!! Form::radio('sexo', 'M', true, ['class' => 'flat']) !!}
        <strong> Feminino: </strong>
        {!! Form::radio('sexo', 'F', null, ['class' => 'flat']) !!}
    </div>  
</div><br>

<div class="row">
    <div class="col-md-3">
        {!! Form::label('input-nascimento', 'Nascimento')!!}
        <span class='obrigatorio'>*</span>
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
                $adotivo->nascimento ?? null,
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
        <span class='obrigatorio'>*</span>
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
                $adotivo->data_chegada ?? null,
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
            $status, 
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
            $etnias, 
            $adotivo->etnia->id ?? null, 
            [
                'class' => 'form-control'
            ])
        !!}
    </div>
</div><br>

<div class="row">
   <div class="col-md-3">
        {!! Form::label('nascionalidade_id', 'Nacionalidade') !!}
        {!! Form::select(
            'nascionalidade_id', 
            $nascionalidades, 
            $adotivo->nascionalidade->id ?? null, 
            [
                'class' => 'form-control',
                'id'    => 'nascionalidade_id' 
            ])
        !!}
    </div> 
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('escolaridade_id', 'Escolaridade') !!}
            <span class='obrigatorio'>*</span>
            {!! Form::select('escolaridade_id', 
                $escolaridades, 
                $adotivo->escolaridade_id ?? null, 
                [
                    'class'       => 'form-control conjuge',
                    'placeholder' => 'Selecione'
                ]) 
            !!}
            <a>
                <span class='validacao-text'> 
                    {{ $errors->first('escolaridade_id') }}
                </span>
            </a>
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::label('restricao_id', 'Possui restrição de saúde?') !!}
        {!! Form::select('restricao_id', 
            $restricoes, 
            $adotivo->restricao_id ?? null, 
            [
                'class' => 'form-control',
                'id'    => 'restricao_id'
            ]) 
        !!}
        <a>
            <span class='validacao-text'> 
                {{ $errors->first('restricao_id') }}
            </span>
        </a>
    </div>
    {{-- <div class="col-md-3">
        {!! Form::label('has_irmaos', 'Possui irmão(s)?') !!}<br>
        {!! Form::checkbox('has_irmaos', 1, false) !!}
    </div> --}}
</div><br>
{{-- {{ $irmaosIds }} --}}
<div class="row">
    <div class="col-md-12">
       {!! Form::label('irmaosIds', 'Irmão(s)') !!}<br>
       {!! Form::select(
           'irmaosIds[]', 
           $irmaos, 
           $irmaosIds ?? null, 
           [
               'class'       => 'form-control',
               'multiple'    => 'multiple',
               'id'          => 'irmaos' 
           ])
       !!} 
    </div>
</div>
<br>

@if(isset($adotivo) && $adotivo->hasAdotantes())
    <div class="row">
        <div class="col-md-12">
            {!! Form::label(null ,'Adotante(s)') !!}<br>
            {!! Form::text(null, $adotante->getNomeEnomeConjuge(),
            [
                'class'    => 'form-control',
                'disabled'
            ]) 
        !!}
        </div>
    </div>
@endif
<br>

<div class="form-group">
    {!! Html::linkAction('AdotivoController@index','Voltar', null, ['class' => 'btn btn-primary']) !!}
    {!! Form::submit($nomeBotaoSubmit, ['class' => 'btn btn-success']) !!}
</div>

{{--Switchery--}}
<script src="{{ asset('assets/vendors/switchery/dist/switchery.min.js') }}"></script>
@section('js')
    <script type="text/javascript">

        function converteData(input, hidden) {
            var date = $(input).val(); 
            date = date.split("/").reverse().join("-");
            $(hidden).val(date);  
        }
      
        $(document).ready(function() {
         
          $("#nascionalidade_id").select2({            
            language: {
                noResults: function() {
                    return "Nacionalidade não encontrada!";
                }
            }
          });

          $("#irmaos").select2({            
            language: {
                noResults: function() {
                    return "Irmã(o) não encontrada(o)!";
                }
            }
          });

          $("#irmaos").select2({
            placeholder: "Selecione irmão(s)",
            maximumSelectionLength: 10,
            language: {
                noResults: function() {
                    return "Irmã(o) não encontrada(o)!";
                },
                maximumSelected: function() {
                    return "Só é possível incluir 10 irmãos no máximo!";
                }
            }
          });
        });
    </script>
@endsection
