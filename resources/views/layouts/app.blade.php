<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Scambi Solidali') }}</title>

    <link href="/css/chosen.min.css" rel="stylesheet">
    <link href="/css/bootstrap-chosen.css" rel="stylesheet">
    <link href="/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.34.0/mapbox-gl.css' rel='stylesheet' />
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.0.1/mapbox-gl-geocoder.css' type='text/css' />
    {!! Minify::stylesheet('/css/app.css') !!}

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ url('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="img-responsive">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            @if (Auth::guest())
                                <a href="{{ url('/register') }}">Registrati</a>
                                <a href="{{ url('/login') }}">Login</a>
                            @else
                                <a href="{{ url('/donazione/mie') }}">Mie Donazioni</a>
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

		<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="tagline">mettiamo in contatto chi opera nel sociale con chi ha qualcosa da regalare!</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ul class="main-menu">
                        <li><a href="{{ url('progetto') }}">Progetto</a></li>
                        <li><a href="{{ url('come-funziona') }}">Regole</a></li>
                        <li><a href="{{ url('celo') }}">Celo</a></li>
                        <li><a href="{{ url('manca') }}">Manca</a></li>
                        <li><a href="{{ url('giocatori') }}">Giocatori</a></li>
                        <li><a href="{{ url('numeri') }}">Vincitori</a></li>
                        <li><a href="{{ url('parlano-di-noi') }}">Parlano di Noi</a></li>
                        <li><a href="{{ url('contatti') }}">Contatti</a></li>
                    </ul>
                </div>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

        	@yield('content')
		</div>

        <br/>
    </div>

    <script src="{{ url('js/app.js') }}"></script>
    <script src="{{ url('js/chosen.jquery.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.it.min.js') }}"></script>
    <script src="{{ url('js/exif.js') }}"></script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.34.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.0.1/mapbox-gl-geocoder.js'></script>
	{!! /* Minify::javascript('/js/mine.js') */ '' !!}
    <script src="{{ url('js/mine.js') }}"></script>
</body>
</html>
