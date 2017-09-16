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
              <div class="col-md-2"></div>
              {!! Form::open(['method' => 'PUT','action' => 'RelatorioAdotivoController@gerar']) !!}

                  <div class="col-md-2">
                      {!! Form::select('dimensao_select', ['1' => '3D', '0' => '2D'], $dimensaoValue ?? true, 
                        [
                          'class' => 'form-control', 

                        ])
                      !!}
                  </div>
                
                  <div class="col-md-3">
                      {!! Form::select('etnia', $etnias, null, 
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
                  {{ Form::hidden('dimensao', $dimensaoValue ) }}
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
              <h2>Gráficos</h2>
              <div class="clearfix"></div>
            </div>
              <div id="grafico" style="height: 80%; width: 100%"></div>
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
    Highcharts.chart('grafico', {
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
          'fontSize' : '30px',
          'color' : '#00BFFF',
          'fontWeight' : 'bold',
        }
      },
      subtitle: {
        text: 'Todos os adotivos da institução',
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
      series: [{
        name: 'Quantidate de adotivos',
        data: dados,
        dataLabels: {
          style: {'fontSize': '12px', 'fontFamily': 'Verdana' }
        }
      }]
    });
  </script>
@endsection 