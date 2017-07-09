{{--Esse hidden é usado na validação --}}
@if(isset($adotante))
    <style type="text/css">
        .select2-selection__choice__remove {
            visibility: hidden;
        }
    </style>
@endif
{!! Form::hidden('id') !!}
{{-- <pre> @{{ $data | json }}</pre> --}}
<fieldset>
    <legend><h3>Adotante</h3></legend>
    <div class="row">
        <div class="col-md-9 col-xs-12 form-group">
            {!! Form::label('nome', 'Nome') !!}
            <span class='obrigatorio'>*</span>
            {!! Form::text('nome', null,
                [
                    'class'       => 'form-control myclass ',
                    'placeholder' => 'Nome completo do Adotante',
                    (isset($solicitacao)) ? 'disabled' : null
                ])
            !!}
            <p>
                <span class='validacao-text'>
                    {{ $errors->first('nome') }}
                </span>
            </p>
        </div>

        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('estado_civil_id', 'Estado Civil') !!}
                <span class='obrigatorio'>*</span>
                {!! Form::select('estado_civil_id',
                    $estadosCivis ,
                    $adotante->estado_civil_id ?? null,
                    [
                        'id'          => 'estado_civil_id',
                        'class'       => 'form-control',
                        'v-model'     => 'estadoCivil',
                        'placeholder' => 'Selecione',
                        'onchange'    => 'limparNomeConjuge()'
                    ])
                !!}
                <p>
                    <span class='validacao-text'>
                        {{ $errors->first('estado_civil_id') }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('escolaridade_id', 'Escolaridade') !!}
                <span class='obrigatorio'>*</span>
                {!! Form::select('escolaridade_id',
                    $escolaridades ,
                    $adotante->escolaridade_id ?? null,
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Selecione'
                    ])
                !!}
                <p>
                    <span class='validacao-text'>
                        {{ $errors->first('escolaridade_id') }}
                    </span>
                </p>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('categoria_profissional_id', 'Categoria Profissional') !!}
                <span class='obrigatorio'>*</span>
                {!! Form::select('categoria_profissional_id',
                    $categoriasProfissionais ,
                    $adotante->categoria_profissional_id ?? null,
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Selecione'
                    ])
                !!}
                <p>
                    <span class='validacao-text'>
                        {{ $errors->first('categoria_profissional_id') }}
                    </span>
                </p>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            {!! Form::label('nascionalidade_id', 'Nacionalidade') !!}
            {!! Form::select(
                'nascionalidade_id',
                $nascionalidades,
                $adotivo->origem->id ?? null,
                [
                    'class' => 'form-control nascionalidade'
                ])
            !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-xs-12">
            <p>
                {!! Form::label('sexo', 'Sexo') !!}<br>
                Masculino:
                {!! Form::radio('sexo', 'M', true, ['class' => 'flat']) !!}
                Feminino:
                {!! Form::radio('sexo', 'F', null, ['class' => 'flat']) !!}
            </p>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('input-nascimento', 'Nascimento')!!}
                <span class='obrigatorio'>*</span>
                {!! Form::text('input-nascimento',
                    (isset($adotante)) ? $adotante->nascimento->formatLocalized('%d/%m/%Y') : null,
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
                <a>
                    <span class='validacao-text'>
                        {{ $errors->first('nascimento') }}
                    </span>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label("cpf", "CPF") !!}
                <span class='obrigatorio'>*</span>
                {{-- A request de validação obriga o envido do cpf --}}
                {!! Form::text((!isset($adotante)) ? 'cpf' : null,
                    $adotante->cpf ?? null,
                    [
                        'class'       => 'form-control',
                        'data-mask'   => '000.000.000-00',
                        'placeholder' => '000.000.000-00',
                        (isset($adotante)) ? 'disabled' : null,
                    ])
                !!}
                {{-- A request de validação obriga o envido do cpf --}}
                @if(isset($adotante))
                    {{ Form::hidden('cpf', $adotante->cpf ) }}
                @endif
                <a>
                    <span class='validacao-text'>
                        {{ $errors->first('cpf') }}
                    </span>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('rg', 'RG') !!}
                <span class='obrigatorio'>*</span>
                {!! Form::text('rg', null,
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Digite o RG do adotante',
                        'maxlength'   => '30'
                    ])
                !!}
                <a>
                    <span class='validacao-text'>
                        {{ $errors->first('rg') }}
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('cep', 'CEP') !!}
                {!! Form::text('cep', null,
                    [
                        'class'       => 'form-control cep',
                        'data-mask'   => '00000-000',
                        'placeholder' => '00000-000',
                        'onchange'    => 'buscarCEP()'
                    ])
                !!}
            </div>
        </div>
        <div class="col-md-7 col-xs-12">
            <div class="form-group">
                <br>
                <span><stron>* Digite o CEP para buscar o endereço</stron></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9 col-xs-12">
            <div class="form-group">
                {!! Form::label('endereco', 'Endereço') !!}
                {!! Form::text('endereco', null,
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Logradouro do(s) adotante(s)'
                    ])
                !!}
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('endereco_numero', 'Número') !!}
                {!! Form::text('endereco_numero', null,
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Número da residência'
                    ])
                !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('complemento', 'Complemento') !!}
                {!! Form::text('complemento', null,
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Complemento do endereço do(s) adotante(s)'
                    ])
                !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-xs-12">
            <div class="form-group">
                {!! Form::label('estado_id', 'Estado') !!}
                {!! Form::select(
                        'estado_id',
                        $estados,
                        $adotante->estado_id ?? null,
                        [
                            'class' => 'form-control estado', 
                            'id'    => 'estado'
                        ]
                    )
                !!}
            </div>
        </div>

        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('cidade', 'Cidade') !!}
                {!! Form::text('cidade', null,
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Nome da cidade do(s) adotante(s)'
                    ])
                !!}
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('bairro', 'Bairro') !!}
                {!! Form::text('bairro', null,
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Nome do Bairro do(s) adotante(s)'
                    ])
                !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            {!! Form::label('email', 'E-mail') !!}
            <span class='obrigatorio'>*</span>
            {!! Form::text('email', null,
                [
                    'class'       => 'form-control',
                    'placeholder' => 'exemplo@exemplo.com.br'
                ])
            !!}
            <p>
                <span class='validacao-text'>
                    {{ $errors->first('email') }}
                </span>
            </p>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('telefone', 'Telefone ') !!}
                <span class='obrigatorio'>*</span>
                {!! Form::text('telefone', null,
                    [
                        'class'       => 'form-control',
                        'data-mask'   => '(00) 0000-0000',
                        'placeholder' => '(00) 0000-0000'
                    ])
                !!}
                <p>
                <span class='validacao-text'>
                    {{ $errors->first('telefone') }}
                </span>
            </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('celular', 'Celular ') !!}
                {!! Form::text('celular', null,
                    [
                        'class'       => 'form-control',
                        'data-mask'   => '(00) 00000-0000',
                        'placeholder' => '(00) 00000-0000'
                    ])
                !!}
            </div>
        </div>
    </div>
</fieldset>
<fieldset id="conjuge">
    <legend><h3>Conjuge</h3></legend>
    <div class="row">
        <div class="col-md-12  col-xs-12 form-group">
            {!! Form::label('conjuge_nome', 'Nome do Cônjuge') !!}
            <span class='obrigatorio'>*</span>
            {!! Form::text('conjuge_nome', null,
                [
                    'class'       => 'form-control conjuge',
                    'placeholder' => 'Nome completo do cônjuge do Adotante',
                    'id'          => 'conjuge_nome'
                ])
            !!}
            <p>
                <span class='validacao-text'>
                    {{ $errors->first('conjuge_nome') }}
                </span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <p>
                {!! Form::label('conjuge_sexo', 'Sexo do Cônjuge') !!}<br>
                Masculino:
                {!! Form::radio('conjuge_sexo', 'M', true, ['class' => 'flat']) !!}
                Feminino:
                {!! Form::radio('conjuge_sexo', 'F', null, ['class' => 'flat']) !!}
            </p>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('input-conjuge-nascimento', 'Data de Nascimento do Cônjuge')!!}
                <span class='obrigatorio'>*</span>
                {!! Form::text('input-conjuge-nascimento',
                    (isset($adotante->conjuge_nascimento)) ? $adotante->conjuge_nascimento->formatLocalized('%d/%m/%Y') : null,
                    [
                        'class'       => 'form-control conjuge',
                        'data-mask'   => '99/99/9999',
                        'placeholder' => '00/00/0000',
                        'id'          => 'input-conjuge-nascimento',
                        'onchange'    => "converteData('#input-conjuge-nascimento', '#hidden_conjuge_nascimento')"
                    ])
                !!}
                {!!
                    Form::hidden('conjuge_nascimento',
                        $adotante->conjuge_nascimento ?? null,
                        [
                            'class' => 'form-control conjuge',
                            'id'    => 'hidden_conjuge_nascimento'
                        ]
                    )
                !!}
                <a>
                    <span class='validacao-text'>
                        {{ $errors->first('conjuge_nascimento') }}
                    </span>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label("conjuge_cpf", "CPF do Cônjuge") !!}
                <span class='obrigatorio'>*</span>
                {{-- A request de validação obriga o envido do cpf --}}
                {!! Form::text(!(isset($adotante->conjuge_cpf)) ? 'conjuge_cpf' : null,
                    $adotante->conjuge_cpf ?? null,
                    [
                        'class'       => 'form-control conjuge',
                        'data-mask'   => '000.000.000-00',
                        'placeholder' => '000.000.000-00',
                        (isset($adotante->conjuge_cpf)) ? 'disabled' : null,
                    ])
                !!}
                {{-- A request de validação obriga o envido do cpf --}}
                @if(isset($adotante->conjuge_cpf))
                    {{ Form::hidden('conjuge_cpf', $adotante->conjuge_cpf ) }}
                @endif
                <a>
                    <span class='validacao-text'>
                        {{ $errors->first('conjuge_cpf') }}
                    </span>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('conjuge_rg', 'RG do Cônjuge') !!}
                <span class='obrigatorio'>*</span>
                {!! Form::text('conjuge_rg', null,
                    [
                        'class'       => 'form-control conjuge',
                        'placeholder' => 'Digite o RG do cônjuge',
                        'maxlength'   => '30'
                    ])
                !!}
                <a>
                    <span class='validacao-text'>
                        {{ $errors->first('conjuge_rg') }}
                    </span>
                </a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('conjuge_escolaridade_id', 'Escolaridade do Cônjuge') !!}
                <span class='obrigatorio'>*</span>
                {!! Form::select('conjuge_escolaridade_id',
                    $escolaridades,
                    $adotante->conjuge_escolaridade_id ?? null,
                    [
                        'class'       => 'form-control conjuge',
                        'placeholder' => 'Selecione'
                    ])
                !!}
                <a>
                    <span class='validacao-text'>
                        {{ $errors->first('conjuge_escolaridade_id') }}
                    </span>
                </a>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('conjuge_categoria_profissional_id', 'Categoria Profissional do Cônjuge') !!}
                <span class='obrigatorio'>*</span>
                {!! Form::select('conjuge_categoria_profissional_id',
                    $categoriasProfissionais ,
                    $adotante->categoria_profissional_id ?? null,
                    [
                        'class'     => 'form-control conjuge',
                        'placeholder' => 'Selecione'
                    ])
                !!}
                <a>
                    <span class='validacao-text'>
                        {{ $errors->first('conjuge_categoria_profissional_id') }}
                    </span>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('adotante_id', 'Adotante(s)') !!}
                {!! Form::select(
                    'conjuge_nascionalidade_id',
                    $nascionalidades,
                    $adotivo->origem->id ?? null,
                    [
                        'class' => 'form-control'
                    ])
                !!}
            </div>
        </div>
    </div>
</fieldset>
<br>
<div class="form-group">
    {!! Html::linkAction('AdotanteController@index','Voltar', null, ['class' => 'btn btn-primary']) !!}
    {!! Form::submit($nomeBotaoSubmit, ['class' => 'btn btn-success']) !!}
</div>

@section('js')
  <script type="text/javascript">
  
    function limparNomeConjuge() {		 
        $('.conjuge').val('');
    }		
    
    $(function() {		
        $('#estado_civil_id').change(function() {		
            if($('#estado_civil_id').val()  == 2 || $('#estado_civil_id').val() == 6) {		
                $('#conjuge').show();		
            } else {		
                $('#conjuge').hide();		
            }		
        });		
    });		
    
    function converteData(input, hidden) {		
        var date = $(input).val();		
        date = date.split("/").reverse().join("-");		
        $(hidden).val(date);		
    }		
    
    $( document ).ready(function() {		
        @if(Request::old('estado_civil_id') != null)		
            var estado_civil = {{ Request::old('estado_civil_id') }};		
        @else		
            var estado_civil = {{ $adotante->estado_civil_id ?? 1}};		
        @endif		
    
        if( estado_civil == 2 || estado_civil == 6) {		
            $('#conjuge').show();		
        } else {		
            $('#conjuge').hide();		
        }		
    });
  </script>
  <script src="{{ asset('js/buscar_cep.js') }}"></script> 
@endsection
