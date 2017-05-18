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
    <link rel="shortcut icon" href="{{ asset('img/casa-black.png') }}" >
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
    <script>
      window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
      ]); ?>
    </script>
  </head>

  @if (Request::is('solicitar-cadastro/create'))
      <nav class="navbar navbar-default navbar-externo">
        <div class="container">
          <div class="navbar">
            <a class="navbar-brand" href="{{ url('/') }}" >
                <img src="{{ asset('img/casa.png') }}" style="display: inline-block">
                <span class="logo-black " style="display: inline-block;">{{ config('app.name', 'Casa') }}</span>
            </a>
            <p class="navbar-text navbar-right pull-right menu-text">
                  <a href="{{ url('/login') }}" class="navbar-link">Entrar</a>
            </p>
          </div>
        </div>
      </nav>
    @endif

    <div class="right_col" role="main" id="app">
      @yield('content')
    </div>

    {{-- Casa Js --}}
    <script src="{{ asset('js/casa.js') }}"></script>
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
    @yield('js')
    {{-- Bootstrap --}}
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    {{-- FastClick --}}
    <script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js') }}"></script>
    {{-- NProgress --}}
    <script src="{{ asset('assets/vendors/nprogress/nprogress.js') }}"></script>
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
  </body>
</html>
