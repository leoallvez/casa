{{-- Esse hidden é usado na validação --}}
{!! Form::hidden('id') !!}

<div class="row">
    <div class="col-md-9 col-xs-12">
        <div class="form-group">
            {!! Form::label('name', 'Nome') !!}
             <span class='obrigatorio'>*</span>
            {!! Form::text('name', null,
                [
                    'class'       => 'form-control',
                    'placeholder' => 'Digite o nome completo do administrador'
                ])
            !!}
            <span class='validacao-text'>
                {{ $errors->first('name') }}
            </span>
        </div>
    </div>
    <div class="col-md-3 col-xs-12">
        <div class="form-group">
            {!! Form::label('nivel_id', 'Nível') !!}
                {!! Form::select('nivel_id', $niveis, $adm->nivel_id ?? Auth::user()->getNivelCadastro(), 
                    [
                        'id'       => 'tipos',
                        'class'    => 'form-control',
                        'disabled'
                    ])
                !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5 col-xs-12">
        <div class="form-group">
            {!! Form::label('cargo', 'Cargo') !!}
             <span class='obrigatorio'>*</span>
            {!! Form::text('cargo', null,
                [
                    'class'       => 'form-control',
                    'placeholder' => 'Digite a cargo do administrador'
                ])
            !!}
            <span class='validacao-text'>
                {{ $errors->first('cargo') }}
            </span>
        </div>
    </div>
     <div class="col-md-4 col-xs-12">
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            <span class='obrigatorio'>*</span>
            {!! Form::text('email', null,
                [
                    'class'       => 'form-control',
                    'placeholder' => 'Digite o e-mail do administrador'
                ])
            !!}
            <span class='validacao-text'>
                {{ $errors->first('email') }}
            </span>
        </div>
    </div>
    <div class="col-md-3 col-xs-12">
        <div class="form-group">
            {!! Form::label("cpf", "CPF") !!}
            <span class='obrigatorio'>*</span>
            {{-- A request de validação obriga o envido do cpf --}}
            {!! Form::text((!isset($adm)) ? 'cpf' : null,
                $adm->cpf ?? null,
                [
                    'class'       => 'form-control',
                    'data-mask'   => '000.000.000-00',
                    'placeholder' => '000.000.000-00',
                    (isset($adm)) ? 'disabled' : null,
                ])
            !!}
            {{-- A request de validação obriga o envido do cpf --}}
            @if(isset($adm))
                {{ Form::hidden('cpf', $adm->cpf ) }}
            @endif
            <a>
                <span class='validacao-text'>
                    {{ $errors->first('cpf') }}
                </span>
            </a>
        </div>
    </div>
</div>
@if(isset($adm))
    <div class="row">
        <div class="col-md-12 col-xs-12">
            {!! Form::label("instituicao", "Instituição") !!}
            {!!
                Form::text("instituicao", $adm->instituicao->razao_social,
                    [
                        'class' => 'form-control',
                        'disabled'
                    ]
                )
            !!}
        </div>
    </div>
@endif
<br>
@if(isset($adm) && Auth::id() == $adm->id)
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('password', 'Senha') !!}
                <small>Minimo 8 caracteres</small>
                {!! (!isset($adm)) ? "<span class='obrigatorio'>*</span>" : null !!}
                {!! Form::password('password',
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Digite a senha do administrador com no mínimo oito caracteres'
                    ])
                !!}
                <span class='validacao-text'>
                    {{ $errors->first('password') }}
                </span>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirmar Senha') !!}
                {!! (!isset($adm)) ? "<span class='obrigatorio'>*</span>" : null !!}
                {!! Form::password('password_confirmation',
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Confirme a senha do administrador'
                    ])
                !!}
                <span class='validacao-text'>
                    {{ $errors->first('password_confirmation') }}
                </span>
            </div>
        </div>
    </div>
@endif

<div class="form-group">
    {!! Html::linkAction('AdmSistemaController@index','Voltar', null, ['class' => 'btn btn-primary']) !!}
    {!! Form::submit($nomeBotaoSubmit, ['class' => 'btn btn-success']) !!}
</div>
