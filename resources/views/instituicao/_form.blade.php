<fieldset>
    <legend><h3>Instituição</h3></legend>
    {{ Form::hidden('instituicao_id', $instituicao->id ?? null) }}
    <div class="row">
        <div class="col-md-9 col-xs-12" >
            <div class="form-group">
                {!! Form::label('razao_social', 'Razão Social') !!}
                {!! Form::text('razao_social', $instituicao->razao_social ?? null, 
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Digite a Razão Social da Instituição',
                        $disabled ? 'disabled' : null,
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
                {!! Form::text('cnpj', $instituicao->cnpj ?? null, 
                    [
                        'class'       => 'form-control', 
                        'data-mask'   => '00.000.000/0000-00',
                        'placeholder' => '00.000.000/0000-00',
                        'disabled',
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
                {!! Form::text('cep', $instituicao->cep ?? null, 
                    [
                        'class'       => 'form-control cep',
                        'data-mask'   => '00000-000',
                        'placeholder' => '00000-000',
                        'onchange'    => 'buscarCEP()',
                        $disabled ? 'disabled' : null,
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('cep') }}
                </span>
            </p>
        </div>
        <div class="col-md-7 col-xs-12">
            <div class="form-group">
                <br>
                <span>
                    <stron>* Digite o CEP para buscar o endereço</stron>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 col-xs-12">
            <div class="form-group">
                {!! Form::label('endereco', 'Endereço') !!}
                {!! Form::text('endereco', $instituicao->endereco ?? null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Digite o Endereço da Instituição',
                        $disabled ? 'disabled' : null,
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
                {!! Form::text('endereco_numero', $instituicao->endereco_numero ?? null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Número da Instituição',
                        $disabled ? 'disabled' : null,
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
                {!! Form::text('complemento', $instituicao->complento ?? null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Digite o Complemento do Endereço da Instituição',
                        $disabled ? 'disabled' : null,
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
                    $instituicao->estadoinstituicao_id ?? null, 
                    [
                        'class' => 'form-control estado',
                        $disabled ? 'disabled' : null,
                    ]) 
                !!}
            </div>
        </div> 
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('cidade', 'Cidade') !!}
                {!! Form::text('cidade', $instituicao->cidade ?? null, 
                    [ 
                        'class'       => 'form-control',
                        'placeholder' => 'Digite a Cidade Onde a Instituição esta Localizada',
                        $disabled ? 'disabled' : null,
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
                {!! Form::text('bairro', $instituicao->bairro ?? null, 
                    [
                        'class'       => 'form-control',
                        'placeholder' => 'Digite Bairro Onde a Instituição esta Localizada',
                        $disabled ? 'disabled' : null,
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
                        $disabled ? 'disabled' : null,
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
                {!! Form::text('telefone', $instituicao->telefone ?? null, 
                    [ 
                        'class' => 'form-control',
                        'data-mask'   => '(00) 0000-0000',
                        'placeholder' => '(00) 0000-0000',
                        $disabled ? 'disabled' : null,
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
    {{-- id do último adm da instituição --}}
    {{ Form::hidden('old_adm_id', $adm->id,['id' => 'old_adm_id']) }}
    <div class="row">
        <div class="col-md-9 col-xs-12">
            @if(Request::is('instituicao/*/edit'))
                <div class="form-group">
                    {!! Form::label('adm_id', 'Nome') !!}
                    {!! Form::select(
                        'adm_id', 
                        $usuarios, 
                        $adm->id ?? null, 
                        [
                            'class'    => 'form-control',
                            'onchange' => 'buscarAdm()',
                        ]) 
                    !!}
                </div>
                {{-- TODO: Quando alterar o select altera o nome do adm --}}
                {{ Form::hidden('name', $adm->name, ['id' => 'name']) }}
            @else
                <div class="form-group">
                    {!! Form::label('name', 'Nome') !!}
                    {!! Form::text('name', $adm->name  ?? null, 
                        [
                            'class'       => 'form-control', 
                            'placeholder' => 'Digite o Nome Completo do Administrador',
                            $disabled ? 'disabled' : null,
                        ]) 
                    !!}
                </div>
                <p>
                    <span class='validacao-text'> 
                        {{ $errors->first('name') }}
                    </span>
                </p>
            @endif
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('cpf', 'CPF') !!}
                {!! Form::text('cpf', $adm->cpf ?? null, 
                    [
                        'class'       => 'form-control', 
                        'data-mask'   => '000.000.000-00',
                        'placeholder' => '000.000.000-00',
                        'disabled',
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
    <div class="row" id="delete_adm">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {{ Form::checkbox('inativar_old_adm', true,['id' => 'inativar_old_adm']) }} Inativar administrador anterior {{ $adm->name }}? 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('cargo', 'Cargo') !!}
                {!! Form::text('cargo', $adm->cargo ?? null, 
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'Digite a Cargo do Administrador do Sistema na Instituição',
                        $disabled ? 'disabled' : null,
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
                {!! Form::text('email_adminstrador', $adm->email ?? null, 
                    [
                        'class'       => 'form-control', 
                        'placeholder' => 'exemplo@exemplo.com.br',
                        'disabled',
                    ]) 
                !!}
            </div>
            <p>
                <span class='validacao-text'> 
                    {{ $errors->first('email_adminstrador') }}
                </span>
            </p>
        </div>
    </div>
</fieldset>
<br>
@if($disabled)
    <div class="form-group">
        <a href="{{ url('/') }}" class='btn btn-primary' >Início</a>
    </div>
@else
    <div class="form-group">
        {!! Html::linkAction('InstituicaoController@index','Voltar', null, ['class' => 'btn btn-primary']) !!}
        {!! Form::submit('Alterar', ['class' => 'btn btn-success']) !!}
    </div>
@endif

@section('js')
  <script>
    $(function() {		
        $('#adm_id').change(function() {	

            console.log("Id do admin selecionado: "+$('#adm_id').val());

            console.log("Id do admin old: "+$('#old_adm_id').val());

            console.log($('#adm_id').val() != $('#old_adm_id').val());

            if($('#adm_id').val() != $('#old_adm_id').val()) {		
                $('#delete_adm').show();		
            } else {		
                $('#delete_adm').hide();
                $('#inativar_old_adm').val(null);		
            }		
        });		
    });	

    $( document ).ready(function() {		
	    $('#delete_adm').hide();	
    });
    
    var url = "{{ url('/').'/usuarios/buscar-adm/' }}";
  </script>
  <script src="{{ asset('js/buscar_cep.js') }}"></script> 
  <script src="{{ asset('js/buscar_adm.js') }}"></script> 
@endsection
