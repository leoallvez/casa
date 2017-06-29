
@extends('layouts.app')

@section('title')
  Analisar Solicitação
@endsection
{{-- Modal de motivo de reprovação --}}
@include('solicitacao.modal_motivo')

@section('content')
    <div role="main">
      <div>
        <div class="page-title">
          <div class="title_left">
            <h3>Analisar Solicitação</h3>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Analisar</h2>
                <div class="clearfix"></div>
              </div>
              @if(isset($instituicao))
                @include('errors.list')
              @endif
              <div class="x_content">
                <br/>
                {!! Form::model($instituicao, ['method' => 'PUT', 'action' => ['SolicitaCadastroController@aprovar', $instituicao->id]]) !!}
                  @include('solicitacao._form', ['nomeBotaoSubmit' => 'Aprovar'])
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
