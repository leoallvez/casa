@extends('layouts.app')

@section('title')
   Relatório de Adotivos
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="col-md-9">
          <h3>{!! Html::linkAction('RelatorioAdotivoController@index','Relatório de Adotivos') !!}</h3>
          <br>
            {!! Form::open(['method' => 'PUT','action' => 'RelatorioAdotivoController@gerar']) !!}
            <div class="row">
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
              <div class="col-md-8">
                <div class="input-group input-daterange">
                  <div class="input-group-addon">Período de </div>
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
              <div class="col-md-4">
                {!! Form::select('sexo',['' => 'Ambos Sexo', 'F' => 'Feminino', 'M' => 'Masculino'], null, 
                  [
                    'class'       => 'form-control',
                    'placeholder' => 'Ambos Sexo',
                    'id'          => 'sexo',
                  ])
                !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                {!! Form::select('etnia', $etnias, null, 
                  [
                    'class'       => 'form-control',
                    'placeholder' => 'Todas Etnias',
                    'id'          => 'etnia',
                  ])
                !!}
              </div>
              <div class="col-md-4">
                {!! Form::select('status', $status, null, 
                  [
                    'class'       => 'form-control',
                    'placeholder' => 'Todos Status',
                    'id'          => 'status',
                  ])
                !!}
              </div>
              <div class="col-md-3">
              {!! Form::select('idade', $idades, null, 
                  [
                    'class'       => 'form-control',
                    'placeholder' => 'Todas Idades',
                    'id'          => 'idade',
                  ])
                !!}
              </div>
              <div class="col-md-2">
                {!! Form::submit('Gerar', ['class' => ' form-control btn btn-success btn-sm']) !!}
              </div>
            </div>
          {!! Form::close() !!}
        
        <div class="content title_right">
          @if($adotivos->count() > 0)
            <h2>Quantidade de registros encontrados: {{ $adotivos->count() }}</h2>
          @elseif($buscaRealizada)
            <h2>Nenhum registro encontrado</h2>  
          @endif
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12">
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
                    @if(!is_null($dadosStatus))
                      <div id="grafico-status"></div><br>
                    @endif
                    @if(!is_null($dadosSexo))
                      <div id="grafico-sexo"></div><br>
                    @endif
                    @if(!is_null($dadosEtnias))
                      <div id="grafico-etnias"></div><br>
                    @endif
                    <div class="form-group">
                      {!! Form::button('Imprimir', ['class' => 'btn btn-primary', 'return onclick' => 'print(this)']) !!}
                    </div>
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
                    <div class="table-responsive">
                      {{-- start list --}}
                      <table class="table table-hover table-general">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Sexo</th>
                            <th>Idade</th>
                            <th>Etnia</th>
                            <th>Status</th>
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
                            <td>{{ $adotivo->etnia->nome }}</td>
                            <td><a>{{ $adotivo->status->nome }}</a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{-- end project list --}}
                    </div>
                    <div class="form-group">
                      {!! Form::button('Imprimir', ['class' => 'btn btn-primary', 'return onclick' => 'print(this)']) !!}
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
  </div>
@endsection

@section('js')

  <script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
  <script src="{{ asset('js/highcharts/highcharts-3d.js') }}"></script>
  <script src="{{ asset('js/highcharts/exporting.js') }}"></script>
  <script src="{{ asset('js/jquery.print.min.js') }}"></script>

  <script type="text/javascript"> 

    $(document).ready(function() {

      $("#periodo_inicio").html(reformatDate($("#data_inicio").val()));
      $("#periodo_fim").html(reformatDate($("#data_fim").val()));
      $("#span_sexo").html($("#sexo option:selected").text());
      $("#span_status").html($("#status option:selected").text());
      $("#span_etnia").html($("#etnia option:selected").text());
      $("#span_idade").html($("#idade option:selected").text());
    });


    function reformatDate(dateStr) {
      dArr = dateStr.split("-");  // ex input "2010-01-18"
      return dArr[2]+ "/" +dArr[1]+ "/" +dArr[0]; //ex out: "18/01/10"
    }


    function print(button) {
      var button = $(button);
      $("#display_filtro").show();
      button.hide();
      $("#printing-area").print();
      $("#display_filtro").hide();
      button.show();
    }
    // GRÁFICO DE STATUS DOS ADOTIVOS
    @if(!is_null($dadosStatus))

      var dadosStatus = {!! json_encode($dadosStatus) !!};

      Highcharts.chart('grafico-status', {
        chart: {
          type: 'pie',
          options3d: {
            enabled: true,
            alpha: 45
          }
        },
        title: {
          text: 'Adotivos por status',
          style: {
            'fontSize' : '30px',
            'color' : '#00BFFF',
            'fontWeight' : 'bold'
          }
        },
        plotOptions: {
          pie: {
            innerSize: 100,
            depth: 45,
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: true,
              format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
              distance: 50,
              filter: {
                property: 'percentage',
                operator: '>',
                value: 4
              }
            }
          }
        },
        series: [{
          name: 'Quantidate de adotivos',
          data: dadosStatus,
          dataLabels: {
            style: {'fontSize': '16px', 'fontFamily': 'Verdana' }
          }
        }]
      });
    @endif
    // GRÁFICO DE SEXO DOS ADOTIVOS
    @if(!is_null($dadosSexo))

      var dadosSexo = {!! json_encode($dadosSexo) !!};

      Highcharts.chart('grafico-sexo', {
        chart: {
          type: 'column',
          options3d: {
            enabled: true,
            alpha: 0
          }
        },
        tooltip: {
          pointFormat: '<b>{series.name}</b><br><b>{point.y:.1f}%</b>',
        },
        colors: ["#ff0080", "#00bfff"],
        title: {
          text: 'Porcentagem de adotivos por sexo',
          style: {
            'fontSize' : '30px',
            'color' : '#00BFFF',
            'fontWeight' : 'bold',
          }
        },
        plotOptions: {
          pie: {
            innerSize: 100,
            depth: 45,
          }
        },
        xAxis: {
          type: 'category'
        },
        yAxis: {
          title: {
            text: 'Porcentagem de adotivos por sexo'
          }
        },
        legend: {
          enabled: false
        },
        plotOptions: {
          series: {
            borderWidth: 0,
            dataLabels: {
              enabled: true,
              format: '{point.y:.1f}%'
            }
          }
        },
        series: [{
          name: 'Porcentagem',
          colorByPoint: true,
          data: dadosSexo ,
          dataLabels: {
            style: {'fontSize': '20px', 'fontFamily': 'Verdana' }
          }
        }]
      });
    @endif

    // GRÁFICO DE ETNIAS
    @if(!is_null($dadosEtnias))

      var dadosEtnia = {!! json_encode($dadosEtnias) !!};

      Highcharts.chart('grafico-etnias', {
        chart: {
          type: 'pie',
          options3d: {
            enabled: false,
            alpha: 0
          }
        },
        title: {
          text: 'Porcentagem de adotivos por etnias',
          style: {
            'fontSize' : '30px',
            'color' : '#00BFFF',
            'fontWeight' : 'bold',
          }
        },
        subtitle: {
          text: '',
          style: {
            'fontSize' : '25px',
          }
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: true,
              format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
              distance: 20,
              filter: {
                property: 'percentage',
                operator: '>',
                value: 4
              }
            }
          }
        },
        yAxis: {
          title: {
            text: 'Porcentagem por etnias'
          }
        },
        legend: {
          enabled: true
        },
        series: [{
          name: 'Quantidade de adotivos',
          data: dadosEtnia,
          style: {
            'fontSize' : '30px'
          },
          dataLabels: {
            style: {'fontSize': '16px', 'fontFamily': 'Verdana' }
          }
        }]
      });
    @endif
  </script>
@endsection 

