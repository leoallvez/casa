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
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            {{-- <pre> @{{ $data | json }}</pre> --}}
            {{-- @include('flash::message') --}}
            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active">
	                    <a href="#tab_historico" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
	                    	Histórico de Vínculos
	                    </a>
                    </li>
                    <li role="presentation" class="">
                    	<a href="#vinculo_atual" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
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
			                        @if( $adotante->hasConjuge())
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
			              Adotivo(a) ainda não teve nenhum vínculo!
			            @endif
			            {{ $adotantesHistorico->links() }}
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="vinculo_atual" aria-labelledby="profile-tab">
                    	<div class="x_title">
			            	<h3>Vínculo Atual</h3>
			             	<div class="clearfix"></div>
			            </div>
			            <div class="x_content">
			            	<div class="row">
			                    <div class="col-md-10">
		                          {!! Form::label('adotante_id', 'Adotante(s)') !!}
		                          {!! Form::select(
		                              'adotante_id', 
		                              $adotantes, 
		                              $adotivo->adotantes->id ?? null, 
		                              [
		                                'class' => 'form-control',
		                                'id'    => 'adotante_id',
		                                'placeholder' => 'Selecione Adotante(s)'
		                              ])
		                          !!}
			                    </div>
								<br>
								<div class="col-md-2">
									@if($adotivo->hasAdotantes())
				                    	{!! Form::submit('Desassociar', ['class' => 'btn btn-danger']) !!}
				                    @else
				                    	{!! Form::submit('Associar', ['class' => 'btn btn-success']) !!}
				                    @endif
								</div>
		                    </div>
	                    </div>
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
    	$(document).ready(function() { 
    		$("#").select2({            
    		  language: {
			     noResults: function() {
			        return "Adotivo não encontrado!";
			    }
    		  }
    		});
    	});
    </script>
@endsection