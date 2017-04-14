@extends('layouts.app')

@section('title')
  Alterar Usuário
@endsection

@section('content')
    <div role="main">
      <div>
        <div class="page-title">
          <div class="title_left">
            <h3>Usuários</h3>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Alterar</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br/>
                {!! Form::model($usuario, 
                    [
                        'method' => 'PATCH', 
                        'action' => ['UsuarioController@update', $usuario->id]
                    ]) 
                !!}
                    @include('usuario._form', ['nomeBotaoSubmit' => 'Alterar'])
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
