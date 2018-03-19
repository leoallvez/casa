@extends('layouts.app')

@section('title')
  Adotivos
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>{!! Html::linkAction('AdotivoController@index','Adotivos') !!}</h3>
          <a class="btn btn-success btn-sm" href="{{ action('AdotivoController@create') }}">
            <i class="fa fa-plus-circle"></i>
            Incluir Adotivo
          </a>
        </div>
        <div class="title_right">
          <div class="col-md-7 col-sm-5 col-xs-12 form-group pull-right top_search">
            {!! Form::open(['action' => 'AdotivoController@buscar', 'method' => 'GET']) !!}
              <div class="input-group">
                {!! Form::text('inputBusca', $inputBusca ?? null,
                  [
                      'class'       => 'form-control',
                      'placeholder' => 'Pesquisar adotivo por nome',
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
            @if($adotivos->count() > 0)
              <div class="table-responsive">
                <p>Listagem dos adotivo ativos.</p>
                {{-- start list --}}
                <table class="table table-hover table-general">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Vínculo?</th>

                      <th class="hidden-in-mobile">Sexo</th>
                      <th class="hidden-in-mobile">Idade</th>
                      <th class="hidden-in-mobile">Etnia</th>
                      <th class="hidden-in-mobile">Status</th>

                      <th>Ação</th>
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
      
                      <td class="hidden-in-mobile">{{ $adotivo->getSexo() }}</td>
                      <td class="hidden-in-mobile" style="padding-right: -5px">
                        {{ $adotivo->calcularIdade() }}
                        <br>
                        <small>
                          Nascimento: <br>
                          {{ $adotivo->nascimento->format('d/m/Y') }}
                        </small>
                      </td>
                      <td class="hidden-in-mobile">{{ $adotivo->etnia->nome }}</td>
                      <td class="hidden-in-mobile"><a>{{ $adotivo->status->nome }}</a></td>
                      <td>
                        <a href="{{ action('AdotivoController@edit', $adotivo->id) }}"
                          class="btn btn-info btn-xs">
                          <i class="fa fa-pencil"></i>
                          Alterar
                        </a>
                        <a href="{{ url('vinculos/adotivo', $adotivo->id) }}"
                          class="btn btn-success btn-xs">
                          <i class="fa fa-heart-o"></i>
                          Vínculos
                        </a>
                        @if(Auth::user()->isAdmInstituicao())
                          @if(!$adotivo->temAdotantes())
                            <a href="javascript:void(0)" class="btn btn-danger btn-xs"
                              v-on:click="excluir({!! $adotivo->id !!})">
                              <i class="fa fa-trash-o"></i>
                              Inativar
                            </a>
                          @else
                            <a href="javascript:void(0)" class="btn btn-danger btn-xs"
                              v-on:click="alertaNaoExcluir()">
                              <i class="fa fa-trash-o"></i>
                              Inativar
                            </a>
                          @endif
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{--End project list --}}
              </div>
            @else
              Não foram encontrados registros na base de dados!
            @endif
          </div>
          {{ $adotivos->links() }}
        </div>
      </div>
    </div>
  </div>
  {{--page content--}}
@endsection

@section('js')
  <script type="text/javascript">
    var url = '{{ url('adotivos{/id}') }}';
  </script>
  <script src="{{ asset('js/casa/min/index.min.js') }}"></script>
@endsection
