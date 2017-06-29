@extends('layouts.app')

@section('title')
  Solicitações Pendentes
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>{!! Html::linkAction('SolicitaCadastroController@index','Solicitações Pendentes') !!}</h3>
          {{-- <a class="btn btn-success btn-sm" href="{{ action('AdotanteController@create') }}">
            <i class="fa fa-plus-circle"></i> 
            Incluir Adotante
          </a> --}}
        </div>
        <div class="title_right">
          <div class="col-md-9 col-sm-5 col-xs-12 form-group pull-right top_search">
            {!! Form::open(['action' => 'SolicitaCadastroController@buscar', 'method' => 'GET']) !!}

              <div class="input-group">
                <input type="text" class="form-control" name="inputBusca" placeholder="Pesquisar instituição por razão social ou CNPJ">
                <span class="input-group-btn">
                  <button class="btn btn-success" type="x" style="color: #FFF">Buscar</button>
                </span>
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
            @include('mensagens.alerta_div')
            @if($solicitacoes->count() > 0)
              <div class="table-responsive">
                <p>Listagem da instituições pendentes de aprovação.</p>
                {{-- start list --}}
                <table class="table table-hover table-general">
                  <thead>
                    <tr>
                      <th>Razão Social</th>
                      <th>CNPJ</th>
                      <th>Telefone</th>
                      <th>E-mail</th>
                      <th>Cidade</th>
                      <th>UF</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($solicitacoes as $solicitacao)
                    <tr>
                      <td>
                        <a>{{ str_limit($solicitacao->razao_social, 40) }}</a>
                        <br>
                        <small>Solicitado: {{ $solicitacao->created_at->format('d/m/Y') }}</small>
                      </td>
                      <td>
                        <a>{{ $solicitacao->cnpj }}</a>
                      </td>
                      <td>
                        <a>{{ $solicitacao->telefone }}</a>
                      </td>
                      <td>
                        <a>{{ $solicitacao->email }}</a>
                      </td>
                      <td>
                        <a>{{ $solicitacao->cidade }}</a>
                      </td>
                      <td>
                        <a>{{ $solicitacao->estado->UF }}</a>
                      </td>
                      <td>
                        <a href="{{ action('SolicitaCadastroController@analisar', $solicitacao->id) }}" class="btn btn-info btn-xs">
                          <i class="fa fa-check-circle-o"></i> 
                            Analisar
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
          {{ $solicitacoes->links() }}
        </div>
      </div>
    </div>
  </div>
  {{-- /page content --}}
@endsection