<!DOCTYPE html>
<html dir="ltr" lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Super Gestão - @yield('titulo')</title>

    <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app/style.min.css') }}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @stack('styles')
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        {{-- TOPO --}}
        @include('app.layouts._partials.header')
        {{-- ASIDE --}}
        @include('app.layouts._partials.aside')

        <div class="page-wrapper">
            @yield('conteudo')
        </div>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/app/app-style-switcher.js') }}"></script>
    <script src="{{ asset('js/app/waves.js') }}"></script>
    <script src="{{ asset('js/app/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/app/custom.js') }}"></script>
    <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('plugins/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('js/app/pages/dashboards/dashboard1.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('scripts')
</body>

</html>
