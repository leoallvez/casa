@extends('layouts.app')

@section('title')
	Agenda de Visitas
@endsection

@section('content')
	<div role="main">
	  <div>
	    <div class="page-title">
	      <div class="title_left">
	        <h3>Agenda de Visitas</h3>
	      </div>
	    </div>
	    <div class="clearfix"></div>
	    <div class="row">
	      <div class="col-md-12 col-sm-12 col-xs-12">
	        <div class="x_panel">
	          <div class="x_title">
	            <h2>Agendar</h2>
	            <div class="clearfix"></div>
	          </div>
	          <div class="x_content">
	            <br/>
                	@include('agenda-visita._calendario')
	          </div>
	        </div>
	      </div>
	    </div>
	</div>
@endsection