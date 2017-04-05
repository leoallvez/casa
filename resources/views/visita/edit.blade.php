@extends('layouts/app')

@section('content')
    <div class="container p-t-md">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Reagendar Visita</div>
                    <div class="panel-body">

                        {!! Form::model(
                                $visita, 
                                ['method' => 'PATCH', 
                                'action' => ['VisitaController@update', $visita->id]]
                            ) 
                        !!}
                            @include('visita._form', ['nomeBotaoSubmit' => 'Reagendar'])
                        {!! Form::close() !!}

                        @include('errors.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
