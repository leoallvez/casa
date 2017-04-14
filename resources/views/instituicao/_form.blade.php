<fieldset>
    <legend><h3>Instituição</h3></legend>
    <div class="row">
        <div class="col-md-9" >
            <div class="form-group">
                {!! Form::label('razao_social', 'Razão Social') !!}
                {!! Form::text('razao_social', $instituicao->razao_social ?? null, 
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Digite a Razão Social da Instituição',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('cnpj', 'CNPJ') !!}
                {!! Form::text('cnpj', $instituicao->cnpj ?? null, 
                    [
                        'class'       => 'form-control', 
                        'data-mask'   => '00.000.000/0000-00',
                        'placeholder' => '00.000.000/0000-00',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                {!! Form::label('endereco', 'Endereço') !!}
                {!! Form::text('endereco', $instituicao->endereco ?? null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Digite o Endereço da Instituição',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('endereco_numero', 'Número') !!}
                {!! Form::text('endereco_numero', $instituicao->endereco_numero ?? null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Número da Instituição',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('complemento', 'Complemento') !!}
                {!! Form::text('complemento', $instituicao->complento ?? null, 
                    [
                        'class'       => 'form-control',

                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('cidade', 'Cidade') !!}
                {!! Form::text('cidade', $instituicao->cidade ?? null, 
                    [ 
                        'class'       => 'form-control',
                        'placeholder' => 'Digite a Cidade Onde a Instituição esta Localizada',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('bairro', 'Bairro ') !!}
                {!! Form::text('bairro', $instituicao->bairro ?? null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' =>'Digite Bairro Onde a Instituição esta Localizada',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('estado_id', 'Estado') !!}
                {!! Form::text('estado_id', $instituicao->estado->UF, 
                    [
                        'class'       => 'form-control',
                        'placeholder' =>'Digite Bairro Onde a Instituição esta Localizada',
                        'disabled' 
                    ]) 
                !!} 
            </div>
        </div>       
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('cep', 'CEP') !!}
                {!! Form::text('cep', $instituicao->cep ?? null, 
                    [
                        'class'       => 'form-control',
                        'data-mask'   => '00000-000',
                        'placeholder' => '00000-000',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('email_instituicao', 'E-mail Instituição') !!}
                {!! Form::text('email_instituicao',$instituicao->email ?? null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'exemplo@exemplo.com.br',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('telefone', 'Telefone ') !!}
                {!! Form::text('telefone', $instituicao->telefone ?? null, 
                    [ 
                        'class' => 'form-control',
                        'data-mask'   => '(00) 0000-0000',
                        'placeholder' => '(00) 0000-0000',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><h3>Administrador</h3></legend>
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                {!! Form::label('name', 'Nome') !!}
                {!! Form::text('name', $usuario->name  ?? null, 
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Digite o Nome Completo do Administrador',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('cpf', 'CPF') !!}
                {!! Form::text('cpf', $usuario->cpf ?? null, 
                    [
                        'class'       => 'form-control', 
                        'data-mask'   => '000.000.000-00',
                        'placeholder' => '000.000.000-00',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('cargo', 'Cargo') !!}
                {!! Form::text('cargo', $usuario->cargo ?? null, 
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Digite a Cargo do Administrador do Sistema na Instituição',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('email_adminstrador', 'E-mail Administrador') !!}
                {!! Form::text('email_adminstrador', $usuario->email ?? null, 
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'exemplo@exemplo.com.br',
                        'disabled'
                    ]) 
                !!}
            </div>
        </div>
    </div>
</fieldset>
<br>

<div class="form-group">
    <a href="{{ url('/') }}" class='btn btn-primary' >Início</a>
</div>
