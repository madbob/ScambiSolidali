<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pagetitle }}</title>
    <meta name="Description" content="Recuperiamo eccedenze alimentari come se ci fosse un domani.">

    <?php $append = time() ?>

    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.34.0/mapbox-gl.css' rel='stylesheet' />
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.0.1/mapbox-gl-geocoder.css' type='text/css' />

    <link rel='stylesheet' href='/css/chosen.min.css?a={{ $append }}' type='text/css' />
    <link rel='stylesheet' href='/css/bootstrap-chosen.css?a={{ $append }}' type='text/css' />
    <link rel='stylesheet' href='/css/bootstrap-datepicker3.min.css?a={{ $append }}' type='text/css' />
    <link rel='stylesheet' href='{{ route('css') }}?a={{ $append }}' type='text/css' />

    <meta name="theme-color" content="#FFF"/>
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:title" content="{{ $pagetitle }}" />
    <meta property="og:image" content="{{ env('APP_URL') }}/images/fb.png" />
    <meta property="og:type" content="website" />
    <meta property="og:country-name" content="Italy" />
    <meta property="og:email" content="{{ env('MAIL_ADMIN') }}" />
    <meta property="og:locale" content="it_IT" />
    <meta property="og:description" content="{{ $pagedescription }}" />

    <meta name="twitter:title" content="{{ env('APP_NAME') }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:url" content="{{ env('APP_URL') }}" />
    <meta name="twitter:image" content="{{ env('APP_URL') }}/images/tw.png" />

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="food-page">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="row">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ route('food') }}">
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <ul class="nav navbar-nav navbar-right primary-6">
                            <li>
                                @if (Auth::guest())
                                    <div class="row">
                                        <div class="col-md-6 text-right city-title">
                                            <span class="city-name">{{ App\Config::getConf('instance_city') }}</span><br>
                                        </div>
                                        <div class="col-md-6 left-border hidden-sm hidden-xs">
                                            <a href="{{ url('/register') }}">Registrati</a>
                                            <a href="{{ url('/login') }}">Login</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="row text-right">
                                        <div class="col-md-6 city-title">
                                            <span class="city-name">{{ App\Config::getConf('instance_city') }}</span>
                                        </div>
                                        <div class="col-md-6 left-border hidden-sm hidden-xs">
                                            <span>Ciao, {{ $currentuser->name }}<br></span>

                                            <a href="{{ url('/donazione/mie') }}">Il Mio Profilo</a>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right primary-2 visible-xs visible-sm navbar-mobile">
                            @if (Auth::guest())
                                <li><a href="{{ route('register') }}">Registrati</a></li>
                                <li><a href="{{ route('login') }}">Login</a></li>
                            @else
                                <li><a href="{{ url('/donazione/mie') }}">Il Mio Profilo</a></li>

                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif

                            <li><a href="{{ route('food.progetto') }}">Progetto</a></li>
                            <li><a href="{{ route('food.come-funziona') }}">Regole</a></li>
                            <li><a href="{{ route('food.giocatori') }}">Giocatori</a></li>
                            <li><a href="{{ route('media.gallery', 'food') }}">Galleria</a></li>
                            <li><a href="{{ route('food.contacts') }}">Contatti</a></li>
                            <li><a href="https://www.facebook.com/celocelofood/">Seguici su <img src="{{ url('images/facebook_icon.png') }}" alt="Facebook"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

		<div class="container food-main-container">
            <div class="row visible-md visible-lg">
                <div class="col-md-12 primary-6">
                    <span class="tagline">
                        recuperiamo eccedenze alimentari come se ci fosse un domani
                        <span class="pull-right"><a href="https://www.facebook.com/celocelofood/">seguici su <img src="{{ url('images/facebook_icon.png') }}" alt="Facebook"></a></span>
                    </span>
                </div>
            </div>

            <div class="row visible-md visible-lg">
                <div class="col-md-12">
                    <ul class="main-menu">
                        <li><a href="{{ route('food.progetto') }}">Progetto</a></li>
                        <li><a href="{{ route('food.come-funziona') }}">Regole</a></li>
                        <li><a href="{{ route('food.giocatori') }}">Giocatori</a></li>
                        <li><a href="{{ route('media.gallery', 'food') }}">Galleria</a></li>
                        <li><a href="{{ route('food.contacts') }}">Contatti</a></li>
                    </ul>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

        	@yield('content')
		</div>

        <br/>
    </div>

    <script src="{{ url('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/chosen.jquery.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.it.min.js') }}"></script>
    <script src="{{ url('js/exif.js') }}"></script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.34.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.0.1/mapbox-gl-geocoder.js'></script>
    <script src="{{ url('js/mine.js') }}?a={{ $append }}"></script>

    @include('generic.tracking')
</body>
</html>
