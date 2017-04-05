@extends('layouts.app')

@section('title')
  Relatório de Adotantes
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>{!! Html::linkAction('RelatorioAdotanteController@index','Relatório de Adotantes') !!}</h3>
        </div>
        <div class="content title_right">
          <div class="row form-group">
              {!! Form::open(['action' => 'RelatorioAdotanteController@index']) !!}
                  <div class="col-md-4">
                      {!! Form::select('estado_civil', $opcoes['estadosCivis'], null, 
                        [
                          'class'       => 'form-control texto-selecao', 
                          'placeholder' => 'Todos os Estados Civis'
                        ])
                      !!}
                  </div>
                  <div class="col-md-3">
                      {!! Form::select('sexo', ['M' => 'Masculino', 'F' => 'Feminino'], null, 
                          [
                            'class'       => 'form-control texto-selecao',
                            'placeholder' => 'Ambos Sexo'
                          ])
                      !!}
                  </div>
                  <div class="col-md-3">
                      {!! Form::select('estado_id', $opcoes['estados'], null, 
                          [
                            'class'       => 'form-control texto-selecao',
                            'placeholder' => 'Todos os Estados'
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
            @if(isset($adotantes))
              <div class="table-responsive">
                <p>Listagem dos adotivos ativos.</p>
                {{-- start list --}}
                <table class="table table-hover table-general">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Estado Civil</th>
                      <th>Sexo</th>
                      <th>Visitas</th>
                      <th class="small text-right">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($adotantes as $adotante)
                    <tr>
                      <td>
                        <a>{{ str_limit($adotante->nome, 40) }}</a>
                        <br>
                        <small>Cadastrado: {{ $adotante->created_at->format('d/m/Y') }}</small>
                      </td>
                      <td>{{ $adotante->estadoCivil['nome'] }}</td>
                      <td>{{ $adotante->getSexo() }}</td>
                      <td>
                        <a>{{ rand( 5, 27)  }} Realizadas</a>
                        <br>
                        <a>{{ rand( 10, 3) }} Canceladas</a>
                      </td>
                      <td class='small'>
                        <a href="{{ action('AdotanteController@edit', $adotante->id) }}">
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
          {{ (isset($adotantes))? $adotantes->links() : null }}
        </div>
      </div>
    </div>
  </div>
  {{-- /page content --}}
@endsection