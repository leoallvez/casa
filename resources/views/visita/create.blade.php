@extends('layouts.app')

@section('content')
    <div class="container p-t-md">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Registrar Visita</div>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'visitas']) !!}
                                @include('visita._form', ['nomeBotaoSubmit' => 'Registrar'])
                        {!! Form::close() !!}
                        @include('errors.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
