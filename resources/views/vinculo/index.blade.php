@extends('layouts.app')

@section('title')
  Vínculos
@endsection

@section('content')
  {{-- page content --}}
  <div role="main">
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>Vínculos do(a) <br>{{ $adotivo->nome }}</h3>
        </div>
        <div class="title_right">
          <div class="col-md-2 col-sm-2 col-xs-2 form-group pull-right top_search">
            <a href="{{ action("AdotivoController@index") }}"class="btn btn-success voltar-btn">
              Voltar
            </a>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            {{-- <pre> @{{ $data | json }}</pre> --}}
            @include('mensagens.alerta_div')
            <div class="x_content">
              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active">
                    <a href="#tab_historico" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                      Histórico de Vínculos
                    </a>
                  </li>
                  <li role="presentation" class="">
                    <a href="#tab_vinculo_atual" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                      Vínculo Atual
                    </a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">

                  <div role="tabpanel" class="tab-pane fade active in" id="tab_historico" aria-labelledby="home-tab">
                    <div class="x_title">
                      <h3>Histórico de Vínculos</h3>
                      <div class="clearfix"></div>
                    </div>
                    @if($adotantesHistorico->count() > 0)
                      <div class="table-responsive">
                        {{-- start list --}}
                        <table class="table table-hover table-general">
                          <thead>
                            <tr>
                              <th>Vínculo</th>
                              <th>Nome</th>
                              <th>Estado Civil</th>
                              <th>Data inicial</th>
                              <th>Data Final</th>
                              <th>Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php ($i = $adotantesHistorico->firstItem())
                            @foreach($adotantesHistorico as $adotante)
                              <tr>
                                <td> {{ $i++ }}º </td>
                                <td>
                                  <a>{{ str_limit($adotante->nome, 40) }}</a>
                                  <br>
                                  <small>Cadastrado: {{ $adotante->created_at->format('d/m/Y') }}</small>
                                </td>
                                <td>
                                  {{ $adotante->estadoCivil->nome }}
                                  <br>
                                  @if($adotante->hasConjuge())
                                    <small>Conjuge: {{ str_limit($adotante->conjuge_nome, 40) }}</small>
                                  @endif
                                </td>
                                <td> {{ date('d/m/Y',strtotime( $adotante->pivot->created_at )) }} </td>
                                <td> {{ date('d/m/Y',strtotime( $adotante->pivot->deleted_at )) }} </td>
                                <td>
                                  <a href="{{ action('VinculoController@visualizar', [$adotivo->id, $adotante->id] ) }}"
                                    class="btn btn-info btn-xs">
                                    <i class="fa fa-file-text-o"></i>
                                    Detalhes
                                  </a>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {{-- end project list --}}
                      </div>
                    @else
                      Adotivo(a) não teve nenhum vínculo desfeito!
                    @endif
                    {{ $adotantesHistorico->links() }}
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_vinculo_atual" aria-labelledby="profile-tab">
                    <div class="x_title">
                      <h3>Vínculo Atual</h3>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row">
                        {!! Form::open(['action' => 'VinculoController@vincular', 'method' => 'PATCH']) !!}
                          <div class="col-md-10">
                            {!! Form::label('adotante_id', 'Adotante(s)') !!}
                              {!! Form::select(
                                'adotante_id',
                                $adotantes,
                                $idAdotanteVinculo ?? null,
                                [
                                  'class' => 'form-control',
                                  'placeholder' => 'Selecione Adotante(s)',
                                  $adotivo->temAdotantes() ? 'disabled' : null,
                                  'style'=> 'width: 100%'
                                ])
                              !!}
                              <br>
                              <p>
                                <span class='validacao-text'>
                                  {{ $errors->first('adotante_id') }}
                                </span>
                              </p>
                            {!! Form::hidden('adotivo_id', $adotivo->id ) !!}
                          </div>
                          <br>
                          <div class="col-md-2">
                            @if($adotivo->temAdotantes())
                              {{-- {!! Form::button('Desassociar', ['class' => 'btn btn-danger']) !!} --}}
                              <a href="javascript:void(0)" class="btn btn-danger" style="margin: 5%" v-on:click="desvincular({!! $adotivo->id !!})">
                                Desvincular
                              </a>
                            @else
                              {!! Form::submit('Víncular', ['class' => 'btn btn-success', 'style'=>'margin: 5%']) !!}
                            @endif
                          </div>
                        {!! Form::close() !!}
                        </div>
                      </div>
                      @if(!is_null($visitas))
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                            <div class="x_title">
                                <h2>Visitas</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content collapse">
                              <ul class="list-unstyled timeline">
                                @if(!$visitas->isEmpty())
                                    @foreach($visitas as $visita)
                                        <li>
                                            <div class="block">
                                                <div class="byline">
                                                    <h4>
                                                        <span>
                                                            Das<b> {{ substr($visita->agenda->hora_inicio, 0, 5) }} </b> às 
                                                            <b> {{ substr($visita->agenda->hora_fim, 0, 5) }}</b>, tempo total 
                                                            <b>{{ $visita->agenda->calcularTempoTotal() }}</b>.
                                                        </span>
                                                    </h4>
                                                </div><br>
                                                <div class="tags">
                                                    <a href="" class="tag">
                                                        <span><b>{{ $visita->agenda->formatarData() }}</b></span>
                                                    </a>
                                                </div>
                                                <div class="block_content">
                                                    <h2 class="title">
                                                      <a>Opinião Adotante(s)</a>
                                                    </h2><br>
                                                    <p class="excerpt">
                                                        {{ $visita->opiniao_adotante }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="block">
                                                <div class="tags">
                                                    <a href="" class="tag">
                                                        <span><b>{{ $visita->agenda->formatarData() }}</b></span>
                                                    </a>
                                                </div>
                                                <div class="block_content">
                                                    <h2 class="title">
                                                        <a>Opinião Adotivo</a>
                                                    </h2><br>
                                                    <p class="excerpt">
                                                        {{ $visita->opiniao_adotivo }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <p>Nenhuma visita registrada para esse vínculo.</p>
                                @endif
                              </ul>    
                            </div>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- /page content --}}
    @endsection

    @section('js')
      <script type="text/javascript">
        
        var url_base = "{{ url('/') }}";

        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');

        var app = new Vue({
          el: '#app',
          methods: {
            desvincular(id_adotivo) {
              swal({
                title: "Tem certeza?",
                text: "O vínculo entre adotivo e adontate(s) será desfeito!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
              }, function(isConfirm) {
                if (isConfirm) {
                  var placeholder = "placeholder='Digite o motivo para o fim do vínculo'";
                  swal({
                    title: "Informe o motivo do fim do vínculo!",
                    text: "<textarea class='form-control sweet-alert-textarea' rows='12' "+placeholder+" id='text-motivo'></textarea><br>",
                    html: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Desvincular",
                    cancelButtonText: "Cancelar",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    showLoaderOnConfirm: false
                  }, function(isConfirm) {
                    if(isConfirm) {
                      var inputValue = $('#text-motivo').val();
                      if (inputValue === false) return false;
                      if (inputValue === "") {
                        swal.showInputError("É obrigatório informar o motivo!");
                        return false
                      }
                      var body = { id_adotivo: id_adotivo, observacoes: inputValue };
                  
                      app.$http.put("{{ url('vinculos/desvincular/') }}", body).then((response) => {
                        console.log(response);
                        
                        swal({
                          title: "Desvinculado!",
                          text: "Adotivo e adotante(s) foram desvinculados!",
                          type: "success"
                        }, function() {
                          //window.location.reload();

                          window.location = url_base + '/vinculos/adotivo/' + id_adotivo + "/#tab_vinculo_atual" ;
                        });
                      }, (response) => {
                        //Colocar uma mensagem de erro aqui.
                      });
                    }
                  }); /** Fim do primeiro if isConfirm */
                } else {
                  swal("Cancelado", "Adotivo e adotante(s) ainda estão associados!", "error");
                }
              });
            }
          }
        });
        $(document).ready(function() {
          $("#adotante_id").select2({
            language: {
              noResults: function() {
                return "Adotante não encontrado!";
              }
            }
          });
          
          if(window.location.hash == "#tab_vinculo_atual") {
            $('a[href="#tab_vinculo_atual"]').tab('show');
          }
        });
      </script>
    @endsection
