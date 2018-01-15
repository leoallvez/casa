@extends('layouts.app')

@section('title')
  Usuários
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>{!! Html::linkAction('UsuarioController@index','Usuários') !!}</h3>
            <a class="btn btn-success btn-sm" href="{{ action('UsuarioController@create') }}">
              <i class="fa fa-plus-circle"></i>
              Incluir Usuário
            </a>
        </div>
        <div class="title_right">
          <div class="col-md-7 col-sm-5 col-xs-12 form-group pull-right top_search">
            {!! Form::open(['action' => 'UsuarioController@buscar', 'method' => 'GET']) !!}
            <div class="input-group">
              {!! Form::text('inputBusca', $inputBusca ?? null,
                [
                  'class'       => 'form-control',
                  'placeholder' => 'Pesquisar usuários por nome ou CPF',
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
            {{-- @include('flash::message') --}}
            @include('mensagens.alerta_div')
            @if($usuarios->count() > 0)
              <div class="table-responsive">
                <p>Listagem dos usuários ativos.</p>
                {{-- start list --}}
                <table class="table table-hover table-general">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Cargo</th>
                      <th>Nível</th>
                      <th>E-mail</th>
                      <th>CPF</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                      <td>
                        <a>{{ str_limit($usuario->name, 40) }}</a>
                        <br>
                        <small>Cadastrado: {{ $usuario->created_at->format('d/m/Y') }}</small>
                      </td>
                      <td>{{ $usuario->cargo }}</td>
                      <td>{{ $usuario->nivel->nome }}</td>
                      <td>{{ $usuario->email }}</td>
                      <td>{{ $usuario->cpf }}</td>
                      <td>
                        <a href="{{ action('UsuarioController@edit', $usuario->id) }}" class="btn btn-info btn-xs">
                          <i class="fa fa-pencil"></i>
                          Alterar
                        </a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-xs" v-on:click="excluir({!! $usuario->id !!})">
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
          {{ $usuarios->links() }}
        </div>
      </div>
    </div>
  </div>
  {{--page content--}}
@endsection

@section('js')
  <script type="text/javascript">
    var url = '{{ url('usuarios{/id}') }}';
  </script>
  <script src="{{ asset('js/casa/index.js') }}"></script>
@endsection
