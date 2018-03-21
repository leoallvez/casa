@extends('layouts.app')

@section('title')
  Agenda Registrar
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3> Agenda Registrar</h3>
        </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Lista</h2>
              <div class="clearfix"></div>
            </div>
            {{-- <pre> @{{ $data | json }}</pre> --}}
            @include('mensagens.alerta_div')
            @if($visitas->count() > 0)
              <div class="table-responsive">
                <p>Listagem das visitas agendada antes de {{ date('d/m/Y') }}</p>
                {{-- start list --}}
                <table class="table table-hover table-general">
                  <thead>
                    <tr>
                      <th>Adotivo</th>
                      <th>Adotante</th>
                      <th>Dia da Visita</th>
                      <th>Hora Inicial</th>
                      <th>Hora Final</th>
                      <th>Tempo Total</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($visitas as $visita)
                      <tr>
                        <td>{{ str_limit($visita->vinculo->adotivo->nome, 25) }}</td>
                        <td>{{ str_limit($visita->vinculo->adotante->nome,25) }}</td>
                        <td>{{ date('d/m/Y',strtotime($visita->agenda->dia))}}</td>
                        <td>{{ substr($visita->agenda->hora_inicio, 0, 5) }}</td>
                        <td>{{ substr($visita->agenda->hora_fim, 0, 5) }}</td>
                        <td>{{ $visita->agenda->calcularTempoTotal() }}</td>
                        <td>
                          <a href="{{ action('AgendaController@registrarVisitaGet', $visita->id) }}"
                            class="btn btn-info btn-xs">
                            <i class="fa fa-file-text-o"></i>
                            Registrar
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- end project list --}}
              </div>
            @else
              Não foram encontrados registros na base de dados!
            @endif
          </div>
          {{--  {{ $visitas->links() }}  --}}
        </div>
      </div>
    </div>
  </div>
  {{-- /page content --}}
@endsection

