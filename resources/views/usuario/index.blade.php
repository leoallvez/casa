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
          @if(Auth::user()->isAdmInsOrUsuarioComum())
            <a class="btn btn-success btn-sm" href="{{ action('UsuarioController@create') }}">
              <i class="fa fa-plus-circle"></i> 
              Incluir Usuário
            </a>
          @endif
        </div>
        <div class="title_right">
          <div class="col-md-7 col-sm-5 col-xs-12 form-group pull-right top_search">
            {!! Form::open(['action' => 'UsuarioController@buscar', 'method' => 'GET']) !!}
            <div class="input-group">
              <input type="text" class="form-control" name="inputBusca" placeholder="Pesquisar usuários por nome ou CPF">
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
                        <a href="#" class="btn btn-danger btn-xs" v-on:click="excluir({!! $usuario->id !!})">
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
  {{-- /page content --}}
@endsection

@section('js')
  <script type="text/javascript">
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');

    var app = new Vue({
      el: '#app',
      methods: {
        excluir(id_usuario) {
          swal({
            title: "Tem certeza?",
            text: "O usuário será inativado!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: false
          }, function(isConfirm) {
            if (isConfirm) {
              var resource = app.$resource("{{ url('usuarios{/id}') }}");
              resource.remove({id: id_usuario }).then((response) => {
                swal({
                  title: "Inativado!",
                  text: "Usuário foi Inativado!",
                  type: "success"
                }, function() {
                  window.location.reload();
                });
              }, (response) => {
                //Colocar uma mensagem de erro aqui Aqui
              });
            } else {
              swal("Cancelado", "Usuário ainda ativo!", "error");
            }
          });
        }
      }
    });
  </script>;
@endsection 