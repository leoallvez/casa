<!DOCTYPE html>
<html lang="en">
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
    {{-- NProgress --}}
    <link href="{{ asset('assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet" />
    {{-- iCheck --}}
    <link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet" />
    {{-- bootstrap-progressbar --}}
    <link href="{{ asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" />
    {{-- JQVMap --}}
    <link href="{{ asset('assets/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    {{-- bootstrap-daterangepicker --}}
    <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    {{-- Custom Theme Style --}}
    <link href="{{ asset('assets/build/css/custom.min.css') }}" rel="stylesheet" />
    {{--CSS Casa CSS --}}
    <link href="{{ asset('css/casa.css') }}" rel="stylesheet" />
    {{-- Scripts --}}
    {{-- Sweet Alert --}}
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet" />
    {{-- Select 2 --}}
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />

    <!-- FullCalendar -->
    <link href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print'/>

    <link href="{{ asset('css/fullcalendar/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/fullcalendar/bootstrapValidator.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/fullcalendar/bootstrap-timepicker.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/fullcalendar/casa-fullcallendar.css') }}" rel="stylesheet" />

    {{--  <link href="{{ asset('css/fullcalendar/theme-fullcalendar.css') }}" rel="stylesheet" />  --}}

    <script>
      window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
      ]); ?>
    </script>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ action('HomeController@index') }}" class="site_title">
                <img src="{{ asset('img/casa-black.png') }}" style="padding: 7%">
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
                <div style="margin-top: 10; padding: 7px; ">
             
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
      @if(!Request::is('relatorio-adotivo'))
        <footer class="pull-botton" id="rodape">
          <div class="pull-right">
            <span class="logo">{{ config('app.name', 'Casa') }}</span> {{ date('Y') }}
          </div>
          <div class="clearfix"></div>
        </footer>
      @endif
    {{-- Footer content --}}
    </div>
    {{-- Vue Js--}}
    <script src="{{ asset('js/vue.min.js') }}"></script>
    {{-- Vue Resource --}}
    <script src="{{ asset('js/vue-resource.min.js') }}"></script>
    {{-- Sweet Alert --}}
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    {{-- jQuery --}}
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    {{-- JQuery Mark--}}
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    {{-- Select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    {{-- Casa Js --}}
    <script src="{{ asset('js/casa.js') }}"></script>
    @yield('js')
    {{-- Bootstrap --}}
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    {{-- FastClick --}}
    <script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js') }}"></script>
    {{-- NProgress --}}
    <script src="{{ asset('assets/vendors/nprogress/nprogress.js') }}"></script>
    {{--Switchery--}}
    <script src="{{ asset('assets/vendors/switchery/dist/switchery.min.js') }}"></script>
    {{-- Chart.js --}}
    <script src="{{ asset('assets/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    {{-- Gauge.js --}}
    <script src="{{ asset('assets/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    {{-- bootstrap-progressbar --}}
    <script src="{{ asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    {{-- iCheck --}}
    <script src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
    {{-- Skycons --}}
    <script src="{{ asset('assets/vendors/skycons/skycons.js') }}"></script>
    {{-- Flot --}}
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.resize.js') }}"></script>
    {{-- Flot plugins --}}
    <script src="{{ asset('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    {{-- DateJS --}}
    <script src="{{ asset('assets/vendors/DateJS/build/date.js') }}"></script>
    {{-- JQVMap --}}
    <script src="{{ asset('assets/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    {{-- Bootstrap-daterangepicker --}}
    <script src="{{ asset('assets/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    {{-- Custom Theme Scripts --}}
    <script src="{{ asset('assets/build/js/custom.min.js') }}"></script>

    <!-- FullCalendar -->
    <script src="{{ asset('js/fullcalendar/bootstrapValidator.min.js') }}"></script>

    <script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>

    <script src="{{ asset('js/fullcalendar/bootstrap-colorpicker.min.js') }}"></script>

    <script src="{{ asset('js/fullcalendar/pt-br.js') }}"></script>

    <script src="{{ asset('js/fullcalendar/bootstrap-timepicker.min.js') }}"></script>

    @yield('calendar-js')
  </body>
</html>
