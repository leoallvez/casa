@extends('layouts.app')

@section('title')
	Minha Instituição
@endsection

@section('content')
	<div role="main">
	  <div>
	    <div class="page-title">
	      <div class="title_left">
	        <h3>Minha Instituição</h3>
	      </div>
	    </div>
	    <div class="clearfix"></div>
	    <div class="row">
	      <div class="col-md-12 col-sm-12 col-xs-12">
	        <div class="x_panel">
	          <div class="x_title">
	            {{-- <h2>Incluir</h2> --}}
	            <div class="clearfix"></div>
	          </div>
	          <div class="x_content">
	            <br/>
                	@include('instituicao._form')
	          </div>
	        </div>
	      </div>
	    </div>
	</div>
@endsection