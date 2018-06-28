@extends('layouts.app')

@section('title')
  Agenda Registrar
@endsection

@section('content')
	<div role="main">
	  <div>
	    <div class="page-title">
	      <div class="title_left">
	        <h3>Agenda</h3>
	      </div>
	    </div>
	    <div class="clearfix"></div>
	    <div class="row">
	      <div class="col-xs-12 col-sm-12 col-md-12">
	        <div class="x_panel">
	          <div class="x_title">
	            <h2>Registrar Visita</h2>
	            <div class="clearfix"></div>
	          </div>
	          <div class="x_content">
	            <br/>
            	{!! Form::model($visita, ['method' => 'PUT', 'action' => ['AgendaController@registrarVisitaPost', $visita->id]]) !!}
                @include('agenda._form', ['nomeBotaoSubmit' => 'Registrar'])
              {!! Form::close() !!}
	          </div>
	        </div>
	      </div>
	    </div>
	</div>
@endsection


@section('style')
  <link href="{{ asset('css/summernote.css') }}" rel="stylesheet" />
@endsection

@section('js')
	<script src="{{ asset('js/summernote.js') }}"></script>
	<script src="{{ asset('js/summernote-pt-BR.js') }}"></script>
	<script type="text/javascript">

		$(document).ready(function() {
			$('.summernote').summernote({
				lang: 'pt-BR',
				toolbar: [
					['style', ['style']],
					['font', ['bold', 'italic', 'underline', 'clear']],
					['fontsize', ['fontsize']],
					['fontname', ['fontname']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['height', ['height']],
					['table', ['table']],
					['insert', ['link', 'hr']],
					['view', ['codeview']]
    		],
				height: 200,
			});
		});
	</script>
@endsection
