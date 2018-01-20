@extends('layouts.externo')

@section('title')
    Login
@endsection

@section('content')
    <div class="container login-casa">
        <div class="row">
            <div class="col-md-5 col-xs-12 col-md-offset-5 col-xs-offset-0">
                <div class="col-md-11 col-xs-12 col-md-offset-4 col-xs-offset-0">
                    {{-- @include('flash::message') --}}
                    @include('mensagens.alerta_div')
                    <div class="panel panel-default login">
                        <div class="panel-heading login-heading">
                            <img src="{{ asset('img/casa-logo.png') }}" class="login-logo-img">
                            <span class="login-logo-font" style="display: inline-block; font-size: 300%;">
                                {{ config('app.name', 'Casa') }}
                            </span>
                        </div>
                        <div class="panel-body ">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                            <input id="email"
                                                type="email"
                                                class="form-control has-feedback-left"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required
                                                autofocus
                                                placeholder="E-mail">
                                            <span class="fa fa-envelope form-control-feedback left" 
                                                  aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                            <input id="password"
                                                type="password"
                                                class="form-control has-feedback-left"
                                                name="password"
                                                required
                                                placeholder="Senha">
                                            <span class="fa fa-lock form-control-feedback left" 
                                                  aria-hidden="true"></span>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8">
                                        <div class="col-md-12 col-xs-12">
                                            <button type="submit" class="btn btn-primary login">
                                                Acessar
                                            </button>
                                            <a class="btn btn-success login" 
                                               href="{{ action('SolicitaCadastroController@create') }}">
                                                Solicitar Cadastro
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
