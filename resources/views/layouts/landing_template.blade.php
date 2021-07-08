<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('storage/'.$data['ui']->content->logo->path)}}" rel="shortcut icon">
    <title>{{  $data['ui']->content->app_name }} | @yield('title')</title>

    <!--====== Google Font ======-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">

    <!--====== Vendor Css ======-->
    <link rel="stylesheet" href="{{ asset('landing_assets/css/vendor.css') }}">

    <!--====== Utility-Spacing ======-->
    <link rel="stylesheet" href="{{ asset('landing_assets/css/utility.css')}}">

    <!--====== App ======-->
    <link rel="stylesheet" href="{{ asset('landing_assets/css/app.css') }}">
    @yield('css')
</head>
<body class="config">
    <div class="preloader is-active">
        <div class="preloader__wrap">

            <img class="preloader__img" src="{{ asset('landing_assets/images/preloader.png') }}" alt=""></div>
    </div>

    <!--====== Main App ======-->
    <div id="app">
        @include('layouts.landing_header')

        <!--====== App Content ======-->
        <div class="app-content">

        @yield('content')

        </div>
        <!--====== End - App Content ======-->
        @include('layouts.landing_footer')
    </div>
    <!--====== End - Main App ======-->


    <!--====== Google Analytics: change UA-XXXXX-Y to be your site's ID ======-->
    {{-- <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script> --}}

    <!--====== Vendor Js ======-->
    <script src="{{ asset('landing_assets/js/vendor.js') }}"></script>

    <!--====== Google Map ======-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-MO9uPLS-ApTqYs0FpYdVG8cFwdq6apw"></script>

    <!--====== Google Map Init ======-->
    {{-- <script src="{{ asset('landing_assets/js/map-init.js') }}"></script> --}}

    <!--====== jQuery Shopnav plugin ======-->
    <script src="{{ asset('landing_assets/js/jquery.shopnav.js') }}"></script>

    <!--====== App ======-->
    <script src="{{ asset('landing_assets/js/app.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('js')
    <!--====== Noscript ======-->
    <noscript>
        <div class="app-setting">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="app-setting__wrap">
                            <h1 class="app-setting__h1">JavaScript is disabled in your browser.</h1>

                            <span class="app-setting__text">Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </noscript>
</body>
</html>
