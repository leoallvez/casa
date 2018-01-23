@extends('layouts.app')

@section('title')
  Instituição
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>{!! Html::linkAction('InstituicaoController@index','Instituição') !!}</h3>
        </div>
        <div class="title_right">
          <div class="col-md-9 col-sm-5 col-xs-12 form-group pull-right top_search">
            {!! Form::open(['action' => 'InstituicaoController@buscar', 'method' => 'GET']) !!}
              <div class="input-group">
                {!! Form::text('inputBusca', $inputBusca ?? null,
                  [
                      'class'       => 'form-control',
                      'placeholder' => 'Pesquisar instituição por razão social ou CNPJ',
                  ])
                !!}
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
            @include('mensagens.alerta_div')
            @if($instituicoes->count() > 0)
              <div class="table-responsive">
                <p>Listagem das instituicões ativas.</p>
                {{-- start list --}}
                <table class="table table-hover table-general">
                  <thead>
                    <tr>
                      <th>Razão social</th>
                      <th>CNPJ</th>
                      <th>Telefone</th>
                      <th>Administrador</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($instituicoes as $instituicao)
                      <tr>
                        <td>
                          <a>{{ str_limit($instituicao->razao_social, 30) }}</a>
                        </td>
                        <td>{{ $instituicao->cnpj }}</td>
                        <td>{{ $instituicao->telefone }}</td>
                        <td>{{ str_limit($instituicao->getAdm()->name, 30) }}</td>
                        <td>
                          <a href="{{ action('InstituicaoController@edit', $instituicao->id) }}" class="btn btn-info btn-xs">
                            <i class="fa fa-pencil"></i>
                            Alterar
                          </a>
                          <a href="#" class="btn btn-danger btn-xs" v-on:click="excluir({!! $instituicao->id !!})">
                            <i class="fa fa-trash-o"></i>
                            Inativar
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
          {{ $instituicoes->links() }}
        </div>
      </div>
    </div>
  </div>
  {{--Page Content--}}
@endsection

@section('js')
  <script type="text/javascript">
    var url = '{{ url('instituicao{/id}') }}';
  </script>
  <script src="{{ asset('js/min/casa/index.min.js') }}"></script>
@endsection

