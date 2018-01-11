<!DOCTYPE html>
<html lang="en" class="login-html">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    {{-- Meta, title, CSS, favicons, etc. --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Casa') }} | @yield('title')</title>
    {{-- CSRF Token --}}
    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}">
    {{-- Icon --}}
    <link rel="shortcut icon" href="{{ asset('img/casa.png') }}" >
    {{-- Bootstrap --}}
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    {{-- Font Awesome --}}
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    {{-- Custom Theme Style --}}
    <link href="{{ asset('assets/build/css/custom.min.css') }}" rel="stylesheet" />
    {{-- Sweet Alert --}}
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet" />
    {{--CSS Casa CSS --}}
    <link href="{{ asset('css/casa.css') }}" rel="stylesheet" />
    <!--
    <script>
      window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
      ]); ?>
    </script>
    -->
  </head>
  <body class="{{ (!Request::is('solicitar-cadastro/create')) ? 'body-login' : 'body-solicitacao' }}">
    @if(Request::is('solicitar-cadastro/create'))
        <nav class="navbar navbar-default navbar-externo">
          <div class="container">
            <div class="navbar">
              <a class="navbar-brand" href="{{ url('/') }}" style="width: 200px">
                <img src="{{ asset('img/casa.png') }}" style="display: inline-block; margin-top: -20px">
                <span class="login-logo-font" style="display: inline-block; ">
                  {{ config('app.name', 'Casa') }}
                </span>
              </a>
              <p class="navbar-text navbar-right pull-right menu-text">
                <a href="{{ url('/login') }}" class="btn btn-info btn-blue">Entrar</a>
              </p>
            </div>
          </div>
        </nav>
    @endif

    @if(Request::is('login'))
    
      <div class="fadein" id="fadein">
        
        @for($i = 1; $i < 17; $i++)

          <img class="img" src='{{ asset("slides/img-".$i.".jpg") }}' style='{{ ($i > 1) ? "display: none" : ""}}'>

        @endfor
      </div>
    @endif
    
    <div class="right_col" role="main" id="app" style="position: relative;">
      @yield('content')
    </div>

    {{-- Sweet Alert --}}
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    {{-- jQuery --}}
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    {{-- JQuery Mark--}}
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    {{-- Casa Js --}}
    <script src="{{ asset('js/casa.js') }}"></script>
    @yield('js')
    {{-- Bootstrap --}}
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    {{-- Custom Theme Scripts --}}
    <script src="{{ asset('assets/build/js/custom.min.js') }}"></script>
  </body>
</html>
