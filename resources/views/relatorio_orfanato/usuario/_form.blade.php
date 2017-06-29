{{-- Esse hidden é usado na validação --}}
{!! Form::hidden('id') !!}

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('name', 'Nome') !!}
             <span class='red'>*</span>
            {!! Form::text('name', null, 
                [
                    'class'       => 'form-control', 
                    'placeholder' => 'Digite o Nome Completo do Usuário'
                ]) 
            !!}
            <span class='validacao-text'> 
                {{ $errors->first('name') }}
            </span>            
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('cpf', 'CPF') !!}
             <span class='red'>*</span>
            {!! Form::text('cpf', null, 
                [
                    'data-mask'   => '000.000.000-00',
                    'placeholder' => '000.000.000-00',
                    'class'       => 'form-control'
                ]) 
            !!}
            <span class='validacao-text'> 
                {{ $errors->first('cpf') }}
            </span> 
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('cargo', 'Cargo') !!}
             <span class='red'>*</span>
            {!! Form::text('cargo', null, 
                [
                    'class'       => 'form-control', 
                    'placeholder' => 'Digite a Cargo do Usuário'
                ]) 
            !!}
            <span class='validacao-text'> 
                {{ $errors->first('cargo') }}
            </span> 
        </div>
    </div>
     <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            <span class='red'>*</span>
            {!! Form::text('email', null, 
                [
                    'class'       => 'form-control', 
                    'placeholder' => 'Digite o Email do Usuário'
                ]) 
            !!}
            <span class='validacao-text'> 
                {{ $errors->first('email') }}
            </span> 
        </div>
    </div>
</div>
@if(!isset($usuario) || Auth::id() == $usuario->id)
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('password', 'Senha') !!}
                <small>Minimo 8 caracteres</small>
                 {!! (!isset($usuario)) ? "<span class='red'>*</span>" : null !!}
                {!! Form::password('password',
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Digite a Senha do Usuário com no mínimo oito caracteres'
                    ]) 
                !!}
                <span class='validacao-text'> 
                    {{ $errors->first('password') }}
                </span> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirmar Senha') !!}
                {!! (!isset($usuario)) ? "<span class='red'>*</span>" : null !!}
                {!! Form::password('password_confirmation',
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Confirme a Senha do Usuário'
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
    {!! Html::linkAction('UsuarioController@index','Voltar', null, ['class' => 'btn btn-primary']) !!}
    {!! Form::submit($nomeBotaoSubmit, ['class' => 'btn btn-success']) !!}
</div>
