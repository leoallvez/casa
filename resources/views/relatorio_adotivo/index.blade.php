@extends('layouts.app')

@section('title')
   Relatório de Adotivos
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>{!! Html::linkAction('RelatorioAdotivoController@index','Relatório de Adotivos') !!}</h3>
        </div>
        <div class="content title_right">
          <div class="row form-group">
              {!! Form::open(['action' => 'RelatorioAdotivoController@index']) !!}
                  <div class="col-md-4">
                      {!! Form::select('status', $opcoes['status'], null, 
                        [
                          'class' => 'form-control', 
                          'placeholder' => 'Todos Status'
                        ])
                      !!}
                  </div>
                  <div class="col-md-3">
                      {!! Form::select('etnia', $opcoes['etnia'], null, 
                          [
                            'class'       => 'form-control',
                            'placeholder' => 'Todas Etnias'
                          ])
                      !!}
                  </div>
                  <div class="col-md-3">
                      {!! Form::select('sexo',['F' => 'Femino', 'M' => 'Masculino'], null, 
                          [
                            'class'       => 'form-control',
                            'placeholder' => 'Ambos Sexo'
                          ])
                      !!}
                  </div>
                  <div class="col-md-2">
                      {!! Form::submit('Gerar', ['class' => ' form-control btn btn-success btn-sm']) !!}
                  </div>
              {!! Form::close() !!}
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Lista</h2>
              <div class="clearfix"></div>
            </div>
            {{-- <pre> @{{ $data | json }}</pre> --}}
            {{-- @include('flash::message') --}}
            @if(isset($adotivos))
              <div class="table-responsive">
                <p>Listagem dos adotivos ativos.</p>
                {{-- start list --}}
                <table class="table table-hover table-general">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Idade</th>
                      <th>Status</th>
                      <th>Etnia</th>
                      <th>Sexo</th>
                      <th>Visitas</th>
                      <th class="text-right">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($adotivos as $adotivo)
                    <tr>
                      <td>
                        <a>{{ str_limit($adotivo->nome, 40) }}</a>
                        <br>
                        <small>Cadastrado: {{ $adotivo->created_at->format('d/m/Y') }}</small>
                      </td>
                      <td>
                        <a>{{ $adotivo->CalcularIdade() }}</a>
                        <br>
                        <small>Nascimento: {{ $adotivo->nascimento->format('d/m/Y') }}</small>
                      </td>
                      <td>{{ $adotivo->status->nome }}</td>
                      <td>{{ $adotivo->etnia->nome }}</td>
                      <td>{{ $adotivo->getSexo() }}</td>
                      <td>
                        <a>{{ rand( 5, 27) }} Recebidas</a>
                        <br>
                        <a>{{ rand( 0, 6) }} Canceladas</a>
                      </td>
                      <td class='small'>
                        <a href="{{ action('AdotivoController@edit', $adotivo->id) }}">
                          <i class="fa fa-edit fa-lg pull-right" title="Alterar"></i>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- end project list --}}
              </div>
            @else
              Clique em <b>gerar</b> para obter um relatório conforme as opções selecionadas
            @endif
          </div>
          {{ (isset($adotivos))? $adotivos->links() : null }}
        </div>
      </div>
    </div>
  </div>
  {{-- /page content --}}
@endsection