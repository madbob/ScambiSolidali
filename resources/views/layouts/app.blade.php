<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pagetitle }}</title>

    <link href="/css/chosen.min.css" rel="stylesheet">
    <link href="/css/bootstrap-chosen.css" rel="stylesheet">
    <link href="/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.34.0/mapbox-gl.css' rel='stylesheet' />
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.0.1/mapbox-gl-geocoder.css' type='text/css' />
    {!! Minify::stylesheet('/css/app.css') !!}

    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:title" content="{{ $pagetitle }}" />
    <meta property="og:image" content="{{ env('APP_URL') }}/images/fb.png" />
    <meta property="og:type" content="website" />
    <meta property="og:country-name" content="Italy" />
    <meta property="og:email" content="{{ env('MAIL_FROM_ADDRESS') }}" />
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
<body>
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
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ url('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="img-responsive">
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <ul class="nav navbar-nav navbar-right primary-2">
                            <li>
                                @if (Auth::guest())
                                    <div class="row">
                                        <div class="col-md-6 text-right city-title">
                                            <span class="city-name">{{ App\Config::getConf('instance_city') }}</span><br>
                                            <small>vai su
                                                @foreach(json_decode(App\Config::getConf('other_instance_cities')) as $city)
                                                    <a href="{{ $city->url }}">{{ $city->name }}</a>
                                                @endforeach
                                            </small>
                                        </div>
                                        <div class="col-md-6 left-border">
                                            <a href="{{ url('/register') }}">Registrati</a>
                                            <a href="{{ url('/login') }}">Login</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-md-4 city-title">
                                            <span class="city-name">{{ App\Config::getConf('instance_city') }}</span>
                                        </div>
                                        <div class="col-md-4">
                                            <span>Ciao, {{ Auth::user()->name }}</span>
                                        </div>
                                        <div class="col-md-4 left-border">
                                            <a href="{{ url('/donazione/mie') }}">Il Mio Profilo</a>
                                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right primary-2 visible-xs visible-sm">
                            <li><a href="{{ url('progetto') }}">Progetto</a></li>
                            <li><a href="{{ url('come-funziona') }}">Regole</a></li>
                            <li><a href="{{ url('celo') }}">Celo</a></li>
                            <li><a href="{{ url('manca') }}">Manca</a></li>
                            <li><a href="{{ url('giocatori') }}">Giocatori</a></li>
                            <li><a href="{{ url('numeri') }}">Vincitori</a></li>
                            <li><a href="{{ url('parlano-di-noi') }}">Parlano di Noi</a></li>
                            <li><a href="{{ url('contatti') }}">Contatti</a></li>
                            <li><a href="https://www.facebook.com/celocelo-190331531485606/">Seguici su <img src="{{ url('images/facebook_icon.png') }}" alt="Facebook"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

		<div class="container">
            <div class="row visible-md visible-lg">
                <div class="col-md-12 primary-2">
                    <span class="tagline">
                        mettiamo in contatto chi opera nel sociale con chi ha qualcosa da regalare!
                        <span class="pull-right"><a href="https://www.facebook.com/celocelo-190331531485606/">seguici su <img src="{{ url('images/facebook_icon.png') }}" alt="Facebook"></a></span>
                    </span>
                </div>
            </div>

            <div class="row visible-md visible-lg">
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

    <script src="{{ url('js/app.js') }}"></script>
    <script src="{{ url('js/chosen.jquery.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.it.min.js') }}"></script>
    <script src="{{ url('js/exif.js') }}"></script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.34.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.0.1/mapbox-gl-geocoder.js'></script>
    @if(env('APP_DEBUG', false) == false)
        {!! Minify::javascript('/js/mine.js') !!}
    @else
        <script src="{{ url('js/mine.js') }}"></script>
    @endif

    <!-- Piwik -->
    <script type="text/javascript">
        var _paq = _paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['disableCookies']);
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//stats.madbob.org/";
            _paq.push(['setTrackerUrl', u+'piwik.php']);
            _paq.push(['setSiteId', '6']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Piwik Code -->
</body>
</html>
