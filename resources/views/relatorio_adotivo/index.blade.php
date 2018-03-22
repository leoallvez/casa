@extends('layouts.app')

@section('title')
  Relatório de Adotivos
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <!--Search Form Start-->
      <div class="x_panel">
        {!! Form::open(['method' => 'PUT','action' => 'RelatorioAdotivoController@gerar']) !!}
        <div class="x_title">
          <h2>
            {!! Html::linkAction('RelatorioAdotivoController@index','Relatório de Adotivos') !!}
          </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li>
              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <span class="flash-message">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
              </ul>
            </span>
          </div>
        @endif

        <div class="x_content">
          <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
              <div class="input-group input-daterange">
                <div class="input-group-addon">De</div>
                {!! Form::date('data_inicio', \Carbon\Carbon::now()->subYears(1),
                  [
                    'class' => 'form-control',
                    'id'    => 'data_inicio',
                  ])
                !!}
                
                <div class="input-group-addon">até</div>
                {!! Form::date('data_fim', \Carbon\Carbon::now(),
                  [
                    'class' => 'form-control',
                    'id'    => 'data_fim',
                  ])
                !!}
              </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-6 form-group">
              {!! Form::select('sexo',['' => 'Ambos Sexo', 'F' => 'Feminino', 'M' => 'Masculino'], null, 
                [
                  'class'       => 'form-control',
                  'placeholder' => 'Ambos Sexo',
                  'id'          => 'sexo',
                ])
              !!}
            </div>

            <div class="col-md-3 col-sm-6 col-xs-6 form-group">
              {!! Form::select('etnia', $etnias, null, 
                [
                  'class'       => 'form-control',
                  'placeholder' => 'Todas Etnias',
                  'id'          => 'etnia',
                ])
              !!}
            </div>
            <br />
            <div class="ln_solid"></div>

            <div class="col-md-3 col-sm-6 col-xs-6 form-group">
              {!! Form::select('status', $status, null, 
                [
                  'class'       => 'form-control',
                  'placeholder' => 'Todos Status',
                  'id'          => 'status',
                ])
              !!}
            </div>

            <div class="col-md-3 col-sm-6 col-xs-6 form-group">
              {!! Form::select('idade', $idades, null, 
                [
                  'class'       => 'form-control',
                  'placeholder' => 'Todas Idades',
                  'id'          => 'idade',
                ])
              !!}
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12 form-group">
              {!! Form::submit('Gerar', ['class' => 'form-control btn btn-success btn-sm']) !!}
            </div>

            <br />
            <div class="ln_solid"></div>

            <div class="col-md-12 col-sm-12 col-xs-12 form-group">

              @if($adotivos->count() > 0)
                <h2>{{ $adotivos->count() }} registros encontrados</h2>
              @elseif($buscaRealizada)
                <h2>Nenhum registro encontrado</h2>  
              @endif
            </div>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
      <!--Search Form End-->

      <div class="clearfix"></div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="x_panel">
            <div role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active">
                  <a href="#tab_grafico" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Gráficos</a>
                </li>
                <li role="presentation" class="">
                  <a href="#tab_listagem" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Listagem</a>
                </li>
              </ul>
              <div id="printing-area" class="tab-content">
                <!-- Mostrar gráfico-->
                <div id="display_filtro" style="display: none">
                  <h1>Relatório</h1><br>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Período Inicial</th>
                        <th scope="col">Período Final</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Etnia</th>
                        <th scope="col">Status</th>
                        <th scope="col">Idade</th>
                        <th scope="col">Quantidade de registros</th>
                        <th scope="col">Data relatório</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>
                          <b><span id="periodo_inicio"></span></b>
                        </th>
                        <td>
                          <b><span id="periodo_fim"></span></b>
                        </td>
                        <td>
                          <b><span id="span_sexo"></span></b>
                        </td>
                        <td>
                          <b><span id="span_etnia"></span></b>
                        </td>
                        <td>
                          <b><span id="span_status"></span></b>
                        </td>
                        <td>
                          <b><span id="span_idade"></span></b>
                        </td>
                        <td>
                          <b>{{ $adotivos->count() }}</br>
                        </th>
                        <td>
                          <b>{{ date('d/m/Y') }}</b>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div role="tabpanel" class="tab-pane fade active in" id="tab_grafico" aria-labelledby="home-tab">
                  
                  @if(!$adotivos->isEmpty())
                    <div class="form-group">
                      {!! Form::button('Imprimir', ['class' => 'btn btn-default pull-right', 'return onclick' => 'print(this)']) !!}
                    </div>

                    <br />
                    <div class="ln_solid"></div>
                  
                    @if(!is_null($dadosStatus))
                      <div id="grafico-status"></div><br>
                    @endif
                    @if(!is_null($dadosSexo))
                      <div id="grafico-sexo"></div><br>
                    @endif
                    @if(!is_null($dadosEtnias))
                      <div id="grafico-etnias"></div><br>
                    @endif
                    
                  @else
                    @if($buscaRealizada)
                      Não foram encontrados registros na base de dados!
                    @else
                      Selecione os filtros e click em gerar.
                    @endif
                  @endif
                </div>
                <!-- Mostrar listagem-->
                <div role="tabpanel" class="tab-pane fade" id="tab_listagem" aria-labelledby="profile-tab">

                  @if(!$adotivos->isEmpty())
                    <div class="form-group">
                      {!! Form::button('Imprimir', ['class' => 'btn btn-default pull-right', 'return onclick' => 'print(this)']) !!}
                    </div>
                    <br />
                    <div class="ln_solid"></div>
                    <div class="table-responsive">
                      {{-- start list --}}
                      <table class="table table-hover table-general">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Sexo</th>
                            <th>Idade</th>
                            <th class="hidden-in-mobile">Etnia</th>
                            <th class="hidden-in-mobile">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($adotivos as $adotivo)
                          <tr>
                            <td>
                              <a>{{ str_limit($adotivo->nome, 40) }}</a>
                              <br>
                              <small>
                                Cadastrado: {{ $adotivo->created_at->format('d/m/Y') }}
                              </small>
                            </td>
                            <td>{{ $adotivo->getSexo() }}</td>
                            <td style="padding-right: -5px">
                              {{ $adotivo->calcularIdade() }}
                              <br>
                              <small>
                                Nascimento: <br>
                                {{ $adotivo->nascimento->format('d/m/Y') }}
                              </small>
                            </td>
                            <td class="hidden-in-mobile">
                              {{ $adotivo->etnia->nome }}
                            </td>
                            <td class="hidden-in-mobile">
                              <a>{{ $adotivo->status->nome }}</a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{-- end project list --}}
                    </div>
                    
                  @else
                    @if($buscaRealizada)
                      Não foram encontrados registros na base de dados!
                    @else
                      Selecione os filtros e click em gerar.
                    @endif
                  @endif
                </div>
              </div>
            </div>       
          </div>
        </div>
      </div>
    </div>
    {!! Form::hidden('dadosStatus', $dadosStatus,[ 'id' => 'dadosStatus']) !!}
    {!! Form::hidden('dadosSexo', $dadosSexo,[ 'id' => 'dadosSexo']) !!}
    {!! Form::hidden('dadosEtnias', $dadosEtnias,[ 'id' => 'dadosEtnias']) !!}

  </div>
@endsection

@section('js')

  <script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
  <script src="{{ asset('js/highcharts/highcharts-3d.js') }}"></script>
  {{--  <script src="{{ asset('js/highcharts/exporting.js') }}"></script>  --}}
  <script src="{{ asset('js/jquery.print.min.js') }}"></script>
  <script src="{{ asset('js/casa/min/relatorio-index.min.js') }}"></script>

@endsection 

