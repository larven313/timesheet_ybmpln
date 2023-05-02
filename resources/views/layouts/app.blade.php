<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
    
    <!-- CSS files -->
    <link href="{{ asset('dist') }}/css/tabler.min.css" rel="stylesheet"/>
    <link href="{{ asset('dist') }}/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="{{ asset('dist') }}/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="{{ asset('dist') }}/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="{{ asset('dist') }}/css/demo.min.css" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
    {{-- header --}}
     @include('partials.header')
    {{-- end of header --}}

      {{-- navbar --}}
      @include('partials.navbar')
      {{-- end of navbar --}}

      <div class="page-wrapper">
        {{-- template --}}
        {{-- end of template --}}
        @yield('container')
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">

              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2023
                    <a href="/" class="link-secondary">Timesheet YBM PLN</a>.
                    All rights reserved.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    @include('partials.script')
</body>
</html>
