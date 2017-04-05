@extends('layouts.app')

@section('title')
  Relatório Orfanato
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>{!! Html::linkAction('RelatorioOrfanatoController@index', 'Relatório Orfanato') !!}</h3>
        </div>
        <div class="content title_right">
          <div class="row form-group">
           <div class="col-md-12">
              <h5 style="margin: 0;">Filtros Adotivos</h5>
            </div>
          </div>
          <div class="row form-group">
              {!! Form::open(['action' => 'RelatorioOrfanatoController@index']) !!}
                  <div class="col-md-4">
                      {!! Form::select('status', $opcoes['status'], null, 
                        [
                          'class'       => 'form-control', 
                          'placeholder' => 'Todos Status'
                        ])
                      !!}
                  </div>
                  <div class="col-md-3">
                      {!! Form::select('etnia', $opcoes['etnias'], null, 
                          [
                            'class'       => 'form-control',
                            'placeholder' => 'Todas Etnias'
                          ])
                      !!}
                  </div>
                  <div class="col-md-3">
                      {!! Form::select('sexo', ['F' => 'Feminino', 'M' => 'Masculino'], null, 
                          [
                            'class'       => 'form-control',
                            'placeholder' => 'Ambos Sexo'
                          ])
                      !!}
                  </div>

                  <div class="col-md-2">
                   {{--  {!! Form::submit('Gerar', ['class' => ' form-control btn btn-success btn-sm']) !!} --}}
                  </div>
              {!! Form::close() !!}
          </div>
          <div class="row form-group">
           <div class="col-md-12">
              <h5 style="margin: 0;">Filtros Adotantes</h5>
            </div>
          </div>
          <div class="row form-group">
              {!! Form::open(['action' => 'RelatorioOrfanatoController@index']) !!}
                  <div class="col-md-4">
                      {!! Form::select('estado_civil', $opcoes['estadosCivis'], null, 
                        [
                          'class'       => 'form-control texto-selecao', 
                          'placeholder' => 'Todos os Estados Civis'
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
                  <div class="col-md-3">
                      {!! Form::select('sexo', ['M' => 'Masculino', 'F' => 'Feminino'], null, 
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
            @if(isset($orfanatos))
              <div class="table-responsive">
                {{-- <p>Listagem dos adotivos ativos.</p> --}}
                {{-- start list --}}
                <table class="table table-hover table-general">
                  <thead>
                    <tr>
                      <th>Instituição</th>
                      <th>Visitas</th>
                      <th>Adoções</th>
                      <th>Adotivos Residentes</th>
                      
                      <th>Adotantes Ativos</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orfanatos as $orfanato)
                    <tr>
                      <td>{{ $orfanato }} </td>
                      <td>
                        <a>{{ rand(10,300) }} Realizadas</a>
                        <br>
                        <a>{{ rand(0,30) }} Canceladas</a>
                      </td>
                      <td>
                        <a>{{ rand(10,300) }} Concluídas</a>
                        <br>
                        <a>{{ rand(0,30) }} Canceladas</a>
                      </td>
                      <td>{{ rand(70,250) }}</td>
                      <td>{{ rand(0,100) }}</td>
                      
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
          {{-- {{ (isset($orfanatos))? $orfanatos->links() : null }} --}}
        </div>
      </div>
    </div>
  </div>
  {{-- /page content --}}
@endsection