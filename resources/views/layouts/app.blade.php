<!DOCTYPE html>
<html lang="en">
  <head>
    {{-- Meta, title, CSS, favicons, etc. --}}
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Casa') }} | @yield('title')</title>
    {{-- CSRF Token --}}
    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}">
    {{-- Icon --}}
    <link rel="shortcut icon" href="{{ asset('img/casa-logo.png') }}" >
    {{-- Bootstrap --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    {{-- Font Awesome --}}
      <link href="{{ asset('css/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    {{-- NProgress --}}
    <link href="{{ asset('css/nprogress.css') }}" rel="stylesheet" />
    {{-- Custom Theme Style --}}
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet" />
    {{--CSS Casa CSS --}}
    <link href="{{ asset('css/casa/dev/bahia.css') }}" rel="stylesheet" />
    {{-- Sweet Alert --}}
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet" />
    {{-- Select 2 --}}
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    @yield('style')

    <!--
    <script>
      window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
      ]); ?>
    </script>
    -->
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ action('HomeController@index') }}" class="site_title">
                <img src="{{ asset('img/casa-logo.png') }}" class="logo-img">
                <span class="logo">{{ config('app.name', 'Casa') }}</span>
              </a>
            </div>
            <div class="clearfix"></div>
            {{-- Sidebar menu --}}             
            @include('partials.menu')
            {{-- Sidebar menu --}}
          </div>
        </div>
        {{-- Top navigation --}}
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              @if (!Auth::guest()) 
                <div class="nav toggle">
                  <a id="menu_toggle">
                    <i class="fa fa-bars"></i>
                  </a>
                </div>
              @endif
              <ul class="nav navbar-nav navbar-right">
                <li>
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }} 
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    @if(Auth::user()->isAdmSistema())
                      <li>
                        <a href="{{ url("administradores-sistema/".Auth::user()->id."/edit") }}">
                          <i class="fa fa-pencil pull-left"></i>
                            Editar minhas informações
                        </a>
                      </li>
                    @else
                      <li>
                        <a href="{{ url("usuarios/".Auth::user()->id."/edit") }}">
                          <i class="fa fa-pencil pull-left"></i>
                          Editar minhas informações
                        </a>
                      </li>
                    @endif
                    <li>
                      <a href="{{ url("instituicao/".Auth::user()->instituicao_id) }}">
                        <i class="fa fa-building pull-left"></i>
                        Minha instituição 
                      </a>
                    </li>
                    <li>
                      <a href="{{ url('/logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out pull-left"></i>
                        Sair
                      </a>
                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        {{-- Top navigation --}}
        {{-- Page content --}}
        <div class="right_col" role="main" id="app">
          @yield('content')
        </div>
        {{-- Page content --}}
      </div>
      {{-- Footer content --}}
      <footer class="pull-botton" id="rodape">
        <div class="pull-left">
          @if(Request::is('visitas')) Para mudanças nos horários de visitas mande um e-mail para <b>contato@casa-sistema.com.br</b> @endif
        </div>
        <div class="pull-right">
          <span class="logo">{{ config('app.name', 'Casa')." " }}</span> 1.0 • <b>{{ date('Y') }}</b>
        </div>
        <div class="clearfix"></div>
      </footer>
    </div>
    {{-- Vue --}}
    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/vue-resource.min.js') }}"></script>
    {{-- Sweet Alert --}}
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    {{-- jQuery --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    {{-- JQuery Mark--}}
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    {{-- Select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    {{-- Casa Js --}}
    <script src="{{ asset('js/casa/min/casa.min.js') }}"></script>
    @yield('js')
    {{-- Bootstrap --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- Custom Theme Scripts --}}
    <script src="{{ asset('js/custom.min.js') }}"></script>
    {{-- DateJS --}}
    <script src="{{ asset('js/date.js') }}"></script>
    {{-- Bootstrap-daterangepicker --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
 
    @yield('calendar-js')
  </body>
</html>
