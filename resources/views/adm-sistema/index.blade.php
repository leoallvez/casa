@extends('layouts.app')

@section('title')
  Administradores do Sistema
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>{!! Html::linkAction('AdmSistemaController@index','Administradores do Sistema') !!}</h3>
            <a class="btn btn-success btn-sm" href="{{ action('AdmSistemaController@create') }}">
              <i class="fa fa-plus-circle"></i>
              Incluir Administrador
            </a>
        </div>
        <div class="title_right">
          <div class="col-md-8 col-sm-5 col-xs-12 form-group pull-right top_search">
            {!! Form::open(['action' => 'AdmSistemaController@buscar', 'method' => 'GET']) !!}
            <div class="input-group">
              {!! Form::text('inputBusca', $inputBusca ?? null,
                [
                    'class'       => 'form-control',
                    'placeholder' => 'Pesquisar administrador por nome ou CPF',
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
            @if($adms->count() > 0)
              <div class="table-responsive">
                <p>Listagem dos administradores ativos.</p>
                {{-- start list --}}
                <table class="table table-hover table-general">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Cargo</th>
                      <th>E-mail</th>
                      <th>CPF</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($adms as $adm)
                    <tr>
                      <td>
                        <a>{{ str_limit($adm->name, 40) }}</a>
                        <br>
                        <small>Cadastrado: {{ $adm->created_at->format('d/m/Y') }}</small>
                      </td>
                      <td>{{ $adm->cargo }}</td>
                      <td>{{ $adm->email }}</td>
                      <td>{{ $adm->cpf }}</td>
                      <td>
                        <a href="{{ action('AdmSistemaController@edit', $adm->id) }}" class="btn btn-info btn-xs">
                          <i class="fa fa-pencil"></i>
                          Alterar
                        </a>
                        <a href="#" class="btn btn-danger btn-xs" v-on:click="excluir({!! $adm->id !!})">
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
          {{ $adms->links() }}
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
        excluir(id) {
          swal({
            title: "Tem certeza?",
            text: "O admistrador será inativado!",
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
              var resource = app.$resource("{{ url('administradores-sistema{/id}') }}");
              resource.remove({id: id}).then((response) => {
                swal({
                  title: "Inativado!",
                  text: "Admistrador foi Inativado!",
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