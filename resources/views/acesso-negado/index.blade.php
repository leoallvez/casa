@extends('layouts.app')

@section('title')
  Acesso Negado
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">

                <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                        <div class="row text-center">
                            <div class="col-md-12 center-block">
                                <img src="{{ asset('img/acesso_negado.png') }}" class="access-denied text-center"><br>
                                <h1>
                                    Acesso negado!
                                </h1>
                                <p>
                                    O controle de acessos impediu sua requisição.</br>
                                    Caso você não concorde com isso, por favor contate um administrador do sistema.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection