@extends('layouts.externo')

@section('title')
    Login
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 login">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                  <img src="{{ asset('img/casa.png') }}" style="display: inline-block">
                  <span class="logo" style="display: inline-block; font-size: 250%">
                    {{ config('app.name', 'Casa') }}
                  </span>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <div class="form-group has-feedback has-feedback-left">
                                  <input id="email"
                                         type="email"
                                         class="form-control"
                                         name="email"
                                         value="{{ old('email') }}"
                                         required
                                         autofocus
                                         placeholder="E-mail">
                                <i class="form-control-feedback glyphicon glyphicon-envelope"></i>
                                </div>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                              <div class="form-group has-feedback has-feedback-left">
                                <input id="password"
                                       type="password"
                                       class="form-control"
                                       name="password"
                                       required
                                       placeholder="Senha">
                                <i class="form-control-feedback glyphicon glyphicon-lock"></i>
                                @if($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    Acessar
                                </button>
                                <a class="btn btn-success" href="{{ action('SolicitaCadastroController@create') }}">
                                    Solicitar Cadastro
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
