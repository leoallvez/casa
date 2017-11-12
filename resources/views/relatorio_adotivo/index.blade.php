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
              {{--  <div class="col-md-2"></div>  --}}
            {{--  {!! Form::open(['method' => 'PUT','action' => 'RelatorioAdotivoController@gerar']) !!}  --}}
            <div class="row">
              <div class="col-md-8">
                <div class="input-group input-daterange">
                    <div class="input-group-addon">Periodo de </div>
                    {!! Form::date('name', \Carbon\Carbon::now(),
                      [
                        'class'       => 'form-control',
                        'placeholder' => 'Todas Etnias'
                      ])
                    !!}
                    <div class="input-group-addon">até</div>
                    {!! Form::date('name', \Carbon\Carbon::now(),
                      [
                        'class'       => 'form-control',
                        'placeholder' => 'Todas Etnias'
                      ])
                    !!}
                </div>
              </div>
              <div class="col-md-4">
                  {!! Form::select('sexo',['F' => 'Femino', 'M' => 'Masculino'], null, 
                      [
                        'class'       => 'form-control',
                        'placeholder' => 'Ambos Sexo'
                      ])
                  !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                {!! Form::select('etnia', $etnias, null, 
                    [
                      'class'       => 'form-control',
                      'placeholder' => 'Todas Etnias'
                    ])
                !!}
              </div>
              <div class="col-md-4">
                {!! Form::select('status', $status, null, 
                    [
                      'class'       => 'form-control',
                      'placeholder' => 'Todos Status'
                    ])
                !!}
              </div>
              <div class="col-md-3">
                {!! Form::select('idade', $idades, null, 
                    [
                      'class'       => 'form-control',
                      'placeholder' => 'Todas Idades'
                    ])
                !!}
              </div>
              <div class="col-md-2">
                  {!! Form::submit('Gerar', ['class' => ' form-control btn btn-success btn-sm']) !!}
              </div>
            </div>
          {{--  {!! Form::close() !!}  --}}
        
        <div class="content title_right">
          <h2>Quantidade de registros encontrados: 109</h2>
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
              <div id="x" class="tab-content">
                <!-- Mostrar gráfico-->
                <div role="tabpanel" class="tab-pane fade active in" id="tab_grafico" aria-labelledby="home-tab">
                  <div id="grafico-status" style="height: 80%; width: 100%; margin: 0 auto"></div>
                  <div id="grafico-sexo" style="height: 80%; width: 100%; "></div>
                  <div id="grafico-etnias" style="height: 80%; width: 100%; "></div>

                  <div class="form-group">
                      {!! Html::link('#','Imprimir', ['class' => 'btn btn-primary']) !!}
                  </div>
                </div>
                <!-- Mostrar listagem-->
                <div role="tabpanel" class="tab-pane fade" id="tab_listagem" aria-labelledby="profile-tab">

                  @if($adotivos->count() > 0)
                    <div class="table-responsive">
                      <p>Listagem dos adotivo ativos.</p>
                      {{-- start list --}}
                      <table class="table table-hover table-general">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Vínculo?</th>
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
                            <td style="padding: 2%">
                              {!!
                                $adotivo->temAdotantes() ? "<i class='fa fa-check-circle fa-lg'></i>" : "<i class='fa fa-circle-thin fa-lg'></i>"
                              !!}
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
                  @else
                    Não foram encontrados registros na base de dados!
                  @endif
                  <div class="form-group">
                      {!! Html::link('#','Imprimir', ['class' => 'btn btn-primary']) !!}
                  </div>
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

  <script src="{{ asset('js/highcharts/code/highcharts.js') }}"></script>
  <script src="{{ asset('js/highcharts/code/highcharts-3d.js') }}"></script>
  <script src="{{ asset('js/highcharts/code/modules/exporting.js') }}"></script>
  <script type="text/javascript"> 
    var dados = {!! json_encode($dadosStatus) !!};
    var dimensao = {!! $dimensaoValue !!};
    /** Munda a dimensão do graficos */
    Highcharts.chart('grafico-status', {
      chart: {
        type: 'pie',
        options3d: {
          enabled: dimensao,
          alpha: 45
        }
      },
      title: {
        text: 'Quantidade de adotivos por status',
        style: {
          'fontSize' : '20px',
          'color' : '#00BFFF',
          'fontWeight' : 'bold',
        }
      },
      subtitle: {
        text: '',
        style: {
          'fontSize' : '20px',
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
        data: dados,
        dataLabels: {
          style: {'fontSize': '10px', 'fontFamily': 'Verdana' }
        }
      }]
    });

    Highcharts.chart('grafico-sexo', {
      chart: {
        type: 'column',
        options3d: {
          enabled: dimensao,
          alpha: 0
        }
      },
      colors: ["#ff0080", "#00bfff"],
      title: {
        text: 'Porcentagem por sexo',
        style: {
          'fontSize' : '20px',
          'color' : '#00BFFF',
          'fontWeight' : 'bold',
        }
      },
      subtitle: {
        text: '',
        style: {
          'fontSize' : '20px',
        }
      },
      plotOptions: {
        pie: {
        innerSize: 100,
        depth: 45
        }
      },
      xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Porcentagem por sexo'
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
      data: [
        {
          name: 'Feminino',
          y: 56.33,
          drilldown: 'Feminino'
        }, 
        {
            name: 'Masculino',
            y: 24.03,
            drilldown: 'Masculino'
        }
        ]
      }]
    });

     Highcharts.chart('grafico-etnias', {
      chart: {
        type: 'pie',
        options3d: {
          enabled: false,
          alpha: 0
        }
      },
    
      title: {
        text: 'Porcentagem por etnias',
        style: {
          'fontSize' : '20px',
          'color' : '#00BFFF',
          'fontWeight' : 'bold',
        }
      },
      subtitle: {
        text: '',
        style: {
          'fontSize' : '20px',
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
      name: 'Brands',
        data: [
            { name: 'Branco(a)', y: 14.33 },
            { name: 'Negro(a)', y: 14.03 },
            { name: 'Indígena', y: 14.38 },
            { name: 'Mulato(a)', y: 14.77 },
            { name: 'Caboclo(a)', y: 14.91 },
            { name: 'Cafuzo(a)', y: 14.2 },
            { name: 'Pardo(a)', y: 14.2 }
        ]
      }]
    });
  </script>
@endsection 

