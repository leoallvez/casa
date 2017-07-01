@extends('layouts.app')

@section('title')
  Administradores do Sistema
@endsection

@section('content')
    <div role="main">
      <div>
        <div class="page-title">
          <div class="title_left">
            <h3>Administradores do Sistema</h3>
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
                {!! Form::model($adm, 
                    [
                        'method' => 'PATCH', 
                        'action' => ['AdmSistemaController@update', $adm->id]
                    ]) 
                !!}
                    @include('adm-sistema._form', ['nomeBotaoSubmit' => 'Alterar'])
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
