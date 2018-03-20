@extends('layouts.app')

@section('title')
  Adotantes
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>{!! Html::linkAction('AdotanteController@index','Adotantes') !!}</h3>
          <a class="btn btn-success btn-sm" href="{{ action('AdotanteController@create') }}">
            <i class="fa fa-plus-circle"></i>
            Incluir Adotante
          </a>
        </div>
        <div class="title_right">
          <div class="col-md-7 col-sm-5 col-xs-12 form-group pull-right top_search">
            {!! Form::open(['action' => 'AdotanteController@buscar', 'method' => 'GET']) !!}
              <div class="input-group">
                {!! Form::text('inputBusca', $inputBusca ?? null,
                  [
                      'class'       => 'form-control',
                      'placeholder' => 'Pesquisar adotante por nome ou CPF',
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Lista</h2>
              <div class="clearfix"></div>
            </div>
            {{-- <pre> @{{ $data | json }}</pre> --}}
            @include('mensagens.alerta_div')
            @if($adotantes->count() > 0)
              <div class="table-responsive">
                <p>Listagem dos adotantes ativos.</p>
                {{-- start list --}}
                <table class="table table-hover table-general">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Vínculo?</th>
                      <th class="hidden-in-mobile">Estado Civil</th>
                      <th class="hidden-in-mobile">Idade</th>
                      <th class="hidden-in-mobile">CPF</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($adotantes as $adotante)
                      <tr>
                        <td>
                          <a>{{ str_limit($adotante->nome, 40) }}</a>
                          <br>
                          <small>Cadastrado: {{ $adotante->created_at->format('d/m/Y') }}</small>
                        </td>
                        <td style="padding: 2%">
                          {!!
                            $adotante->hasAdotivos() ? "<i class='fa fa-check-circle fa-lg'></i>" : "<i class='fa fa-circle-thin fa-lg'></i>"
                          !!}
                        </td>
                        <td class="hidden-in-mobile">
                          {{ $adotante->estadoCivil->nome }}
                          <br>
                          @if( $adotante->hasConjuge())
                            <small>Conjuge: {{ str_limit($adotante->conjuge_nome, 40) }}</small>
                          @endif
                        </td>
                        <td class="hidden-in-mobile">{{ $adotante->getIdade() }} Anos</td>
                        <td class="hidden-in-mobile">{{ $adotante->cpf }}</td>
                        <td>
                          <a href="{{ action('AdotanteController@edit', $adotante->id) }}" class="btn btn-info btn-xs">
                            <i class="fa fa-pencil"></i>
                            Alterar
                          </a>
                          @if(Auth::user()->isAdmInstituicao())
                            @if(!$adotante->hasAdotivos())
                              <a href="javascript:void(0)" class="btn btn-danger btn-xs" v-on:click="excluir({!! $adotante->id !!})">
                                <i class="fa fa-trash-o"></i>
                                Inativar
                              </a>
                            @else
                              <a href="javascript:void(0)" class="btn btn-danger btn-xs" v-on:click="alertaNaoExcluir()">
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
                {{-- end project list --}}
              </div>
            @else
              Não foram encontrados registros na base de dados!
            @endif
          </div>
          {{ $adotantes->links() }}
        </div>
      </div>
    </div>
  </div>
  {{-- /page content --}}
@endsection

@section('js')
  <script type="text/javascript">
    var url = '{{ url('adotantes{/id}') }}';
  </script>
  <script src="{{ asset('js/casa/min/index.min.js') }}"></script>
@endsection
