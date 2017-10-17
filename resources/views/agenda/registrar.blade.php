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
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Lista</h2>
              <div class="clearfix"></div>
            </div>
            {{-- <pre> @{{ $data | json }}</pre> --}}
            @include('mensagens.alerta_div')
            @if($visitas->count() > 0)
              <div class="table-responsive">
                <p>Listagem das visitas cadastradas antes de hoje.</p>
                {{-- start list --}}
                <table class="table table-hover table-general">
                  <thead>
                    <tr>
                      <th>Dia</th>
                      <th>Hora Inicial</th>
                      <th>Hora Final</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($visitas as $visita)
                      <tr>
                        <td>{{ $visita->agenda->dia }}</td>
                        <td>{{ $visita->agenda->hora_inicio}}</td>
                        <td>{{ $visita->agenda->hora_fim }}</td>
                        <td>{{ $visita->agenda->status }}</td>
                        <td>
                        <!--Botãoes-->
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
          {{--  {{ $instituicoes->links() }}  --}}
        </div>
      </div>
    </div>
  </div>
  {{-- /page content --}}
@endsection

