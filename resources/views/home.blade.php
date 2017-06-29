@extends('layouts.app')

@section('title')
  Home
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    @include('flash::message')
                    <div class="panel-heading">Casa</div>
                    <div class="panel-body">
                        <i> Bem-vindo</i> <b>{{Auth::user()->name }}</b><i>você esta em</i>
                        <span class="logo">{{ config('app.name', 'Casa') }}!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
