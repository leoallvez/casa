@extends('layouts.app')

@section('title')
  Vínculos
@endsection

@section('content')
	<div role="main">
	  <div>
	    <div class="page-title">
	      <div class="title_left">
	        <h3>Visualizar Histórico de Vínculos</h3>
	      </div>
	    </div>
	    <div class="clearfix"></div>
	    <div class="row">
	      <div class="col-md-12 col-sm-12 col-xs-12">
	        <div class="x_panel">
	          <div class="x_title">
	            <h2>Detalhes do vínculo do adotivo {{ $adotivo->nome }}</h2>
	            <div class="clearfix"></div>
	          </div>
	          <div class="x_content">
	            <br/>
                	@include('vinculo._form')
	          </div>
	        </div>
	      </div>
	    </div>
	</div>
@endsection