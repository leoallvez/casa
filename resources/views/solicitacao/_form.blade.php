<fieldset>
    <legend><h3>Instituição</h3></legend>
    <div class="row">
        <div class="col-md-9 col-xs-12" >
            <div class="form-group">
                {!! Form::label('razao_social', 'Razão Social') !!}
                {!! Form::text('razao_social', null, 
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Digite a Razão Social da Instituição',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('razao_social') }}
                </span>
            </p> 
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('cnpj', 'CNPJ') !!}
                {!! Form::text('cnpj', null, 
                    [
                        'class'       => 'form-control', 
                        'data-mask'   => '00.000.000/0000-00',
                        'placeholder' => '00.000.000/0000-00',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('cnpj') }}
                </span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-xs-12">
            <div class="form-group">
                {!! Form::label('cep', 'CEP') !!}
                
                {!! Form::text('cep', null, 
                    [
                        'class'       => 'form-control',
                        'data-mask'   => '00000-000',
                        'placeholder' => '00000-000',
                        'onchange'    => 'buscarCEP()',
                        (isset($instituicao)) ? 'disabled' : null 
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('cep') }}
                </span>
            </p>
        </div>
        @if(Request::is('solicitar-cadastro/create'))
            <div class="col-md-7 col-xs-12">
                <div class="form-group">
                    <br>
                    <span>
                        <stron>* Digite o CEP para buscar o endereço</stron>
                    </span>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-9 col-xs-12">
            <div class="form-group">
                {!! Form::label('endereco', 'Endereço') !!}
                {!! Form::text('endereco', null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Digite o Endereço da Instituição',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('endereco') }}
                </span>
            </p>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('endereco_numero', 'Número') !!}
                {!! Form::text('endereco_numero', null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Número da Instituição',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('endereco_numero') }}
                </span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('complemento', 'Complemento') !!}
                {!! Form::text('complemento', null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Digite o Complemento do Endereço da Instituição',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
        </div>
    </div>

    <div class="row">
		@if(!isset($instituicao))
            <div class="col-md-2 col-xs-12">
                <div class="form-group">
                    {!! Form::label('estado_id', 'Estado') !!}
                    {!! Form::select(
                            'estado_id', 
                            $estados, 
                            $instituicao->estadoinstituicao_id ?? null, 
                            ['class' => 'form-control estado', 'id' => 'estado']
                        ) 
                    !!}
                </div>
            </div>
        @else
            <div class="col-md-2 col-xs-12">
                <div class="form-group">
                    {!! Form::label('estado_id', 'Estado') !!}
                    {!! Form::text('estado_id', $instituicao->estado->UF, 
                        [
                            'class'       => 'form-control',
                            'placeholder' =>'Digite Bairro Onde a Instituição esta Localizada',
                            (isset($instituicao)) ? 'disabled' : null 
                        ]) 
                    !!} 
                </div>
         </div>       
        @endif
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('cidade', 'Cidade') !!}
                {!! Form::text('cidade', null, 
                    [ 
                        'class'       => 'form-control',
                        'placeholder' => 'Digite a Cidade Onde a Instituição esta Localizada',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('cidade') }}
                </span>
            </p>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('bairro', 'Bairro ') !!}
                {!! Form::text('bairro', null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' =>'Digite Bairro Onde a Instituição esta Localizada',
                        (isset($instituicao)) ? 'disabled' : null 
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('bairro') }}
                </span>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('email_instituicao', 'E-mail Instituição') !!}
                {!! Form::text('email_instituicao',$instituicao->email ?? null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'exemplo@exemplo.com.br',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('email_instituicao') }}
                </span>
            </p>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('telefone', 'Telefone ') !!}
                {!! Form::text('telefone', null, 
                    [ 
                        'class' => 'form-control',
                        'data-mask'   => '(00) 0000-0000',
                        'placeholder' => '(00) 0000-0000',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('telefone') }}
                </span>
            </p>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><h3>Administrador</h3></legend>
    <div class="row">
        <div class="col-md-9 col-xs-12">
            <div class="form-group">
                {!! Form::label('name', 'Nome') !!}
                {!! Form::text('name', $usuario->name  ?? null, 
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Digite o Nome Completo do Administrador',
                        (isset($instituicao)) ? ' disabled' : null
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('name') }}
                </span>
            </p>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('cpf', 'CPF') !!}
                {!! Form::text('cpf', $usuario->cpf ?? null, 
                    [
                        'class'       => 'form-control', 
                        'data-mask'   => '000.000.000-00',
                        'placeholder' => '000.000.000-00',
                        (isset($instituicao)) ? ' disabled' : null
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('cpf') }}
                </span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('cargo', 'Cargo') !!}
                {!! Form::text('cargo', $usuario->cargo ?? null, 
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Digite a Cargo do Administrador do Sistema na Instituição',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('cargo') }}
                </span>
            </p>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('email_adminstrador', 'E-mail Administrador') !!}
                {!! Form::text('email_adminstrador', $usuario->email ?? null, 
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'exemplo@exemplo.com.br',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
            <span class='validacao-text'> 
                {{ $errors->first('email_adminstrador') }}
            </span>
        </div>
    </div>
    @if(!isset($instituicao))
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('password', 'Senha') !!}
                {!! Form::password('password',
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Digite a Senha do Administrador com no mínimo oito caracteres',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
            <span class='validacao-text'> 
                {{ $errors->first('password') }}
            </span>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirmar Senha') !!}
                {!! Form::password('password_confirmation',
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Confirme a Senha do Administrador',
                        (isset($instituicao)) ? 'disabled' : null
                    ]) 
                !!}
            </div>
            <span class='validacao-text'> 
                {{ $errors->first('password_confirmation') }}
            </span>
        </div>
    </div>
    @endif
</fieldset>
<br>
<div class="form-group">
    @if(isset($instituicao))
        {{ Html::linkAction(
                'SolicitaCadastroController@index',
                'Voltar', 
                [], 
                ['class' => 'btn btn-primary']
            ) 
        }}
    @endif
    {!! Form::submit(
            $nomeBotaoSubmit, 
            ['class' => (isset($instituicao))? 'btn btn-success' : 'btn btn-primary btn-blue']
        ) 
    !!}
    @if(isset($instituicao))
        <button 
            type="button" 
            class="btn btn-danger" 
            data-toggle="modal" 
            data-target="#myModalHorizontal">
            Reprovar
        </button>
    @endif
    <p>
        <span class='validacao-text'> 
            {{ $errors->first('motivo_reprovacao') }}
        </span>
    </p>
</div>

@section('js')
  <script type="text/javascript">

    var request = null;

    function createRequest() {
        //Criar um novo objeto para fazer solicitações AJAX ao servidor.
        try {
        request = new XMLHttpRequest();
        } catch (trymicrosoft) {
        try {
                request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (othermicrosoft) {
                try {
                request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (failed) {
                request = null;
                }
            }
        }
        if (request == null)
         console.log("Error creating request object!");
    }
    /**
        Todo o código abaixo da condicional “if (request.readyState == 4)” 
        será executado quando a solicitação ao servidor for totalmente concluída, 
        ou seja, quando uma resposta for trazida do servidor.
    */
    function atualizaPagina() {

        if (request.readyState == 4) {
            
            var result = request.responseText;
            // Convertendo Jso em um objeto javascript
            result = JSON.parse(result);
            if(result.status){
                $('#endereco').val(result.endereco.ds_abrev_logradouro);
                $('#cidade').val(result.endereco.ds_localidade);
                $('#bairro').val(result.endereco.ds_bairro);
                
                var id_estado = buscarIdEstado(result.endereco.ds_uf);
                //Select de Estado.
                $('.estado option')
                    .removeAttr('selected')
                    .filter('[value='+id_estado+']')
                    .attr('selected', true);
            } else {
                swal({
                    title: "CEP não encontrado!",
                    text: "Você ainda pode preencher as informações de endereço manualmente.",
                    showConfirmButton: true
                });
            }
        }
    }

    function buscarCEP() {
        createRequest();
        // Pegando o valor cep digitado
        var cep = $('#cep').val();
        // A url da API que será feita a consulta
        var url = "{{ Config::get('app.api-url') }}"+cep;
        request.open("GET", url, true);
        request.onreadystatechange = atualizaPagina;

        request.send(null);
    }
  </script>
@endsection
