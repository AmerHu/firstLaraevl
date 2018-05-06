<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cs-skin-elastic.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/vector-map/jqvmap.min.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
<style>
    html, body {
        max-width: 100%;
        overflow-x: hidden;
    }
</style>
</head>
<body >

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/"><img src="/images/logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="/"><img src="/images/logo2.png" alt="Logo"></a>
        </div>
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @if(Auth::check())
                    <h3 class="menu-title">Controls</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"> User</a>
                        <ul class="sub-menu children active dropdown-menu">
                            <li>
                                <a href='/user/admin'> Show User</a>
                            </li>
                            <li>
                                <a href='/user/create'> New User</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">Category</a>
                        <ul class="sub-menu children active dropdown-menu">
                            <li>
                                <a href='/category/admin'> Show Category</a>
                            </li>
                            <li>
                                <a href='/category/create'> New Category</a>
                            </li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"> Items</a>
                        <ul class="sub-menu children active dropdown-menu">
                            <li>
                                <a href='/items/admin'> Show Items</a>
                            </li>
                            <li>
                                </i><a href='/items/create'> New Item</a>
                            </li>

                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"> Description</a>
                        <ul class="sub-menu children active dropdown-menu">
                            <li>
                                <a href='/desc/admin'> Show Description</a>
                            </li>
                            <li>
                                <a href='/desc/create'> New Description</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"> Extra Items</a>
                        <ul class="sub-menu children active dropdown-menu">
                            <li>
                                <a href='/extra/admin'> Show Extra Items</a>
                            </li>
                            <li>
                                <a href='/extra/create'> New Extra Items</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"> Offers</a>
                        <ul class="sub-menu children active dropdown-menu">
                            <li>
                                <a href='/offers/admin'> Show Offers</a>
                            </li>
                            <li>
                                <a href='/offers/create'> New Offers</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">Compo Offers</a>
                        <ul class="sub-menu children active dropdown-menu">
                            <li>
                                <a href='/compo/admin'> Show Compo Offers</a>
                            </li>
                            <li>
                                <a href='/compo/create'> New Compo Offers</a>
                            </li>
                        </ul>
                    </li>


                @endif
            </ul>
        </div>


    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-3">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            </div>
            <div class="col-sm-7">
                @yield('header')
            </div>
            @if(Auth::check())
                <div class="col-sm-2">
                    <h3>
                        <a href="/logout">Logout</a>
                    </h3>
                </div>
            @endif

        </div>

    </header>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/vendor/jquery-2.1.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>


<script src="{{ asset('js/lib/chart-js/Chart.bundle.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="{{ asset('js/widgets.js') }}"></script>
<script src="{{ asset('js/lib/vector-map/jquery.vmap.js') }}"></script>
<script src="{{ asset('js/lib/vector-map/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('js/lib/vector-map/jquery.vmap.sampledata.js') }}"></script>
<script src="{{ asset('js/lib/vector-map/country/jquery.vmap.world.js') }}"></script>
<script>
    (function ($) {
        "use strict";
        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#1de9b6', '#03a9f5'],
            normalizeFunction: 'polynomial'
        });
    })(jQuery);
</script>
</body>
</html>
