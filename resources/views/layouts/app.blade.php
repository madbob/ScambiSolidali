<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pagetitle }}</title>
    <meta name="Description" content="{{ App\Config::getConf('main_tagline') }}">

    <?php $append = time() ?>

    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css' type='text/css' />

    <link rel='stylesheet' href='/css/chosen.min.css?a={{ $append }}' type='text/css' />
    <link rel='stylesheet' href='/css/bootstrap-chosen.css?a={{ $append }}' type='text/css' />
    <link rel='stylesheet' href='/css/bootstrap-datepicker3.min.css?a={{ $append }}' type='text/css' />
    <link rel='stylesheet' href='{{ route('css') }}?a={{ $append }}' type='text/css' />

    <meta name="theme-color" content="#FFF"/>
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:title" content="{{ $pagetitle }}" />

    <?php $cityname = currentInstance() ?>

    @if(file_exists(public_path('/images/fb_' . $cityname . '.png')))
        <meta property="og:image" content="{{ env('APP_URL') }}/images/fb_{{ $cityname }}.png" />
    @else
        <meta property="og:image" content="{{ env('APP_URL') }}/images/fb.png" />
    @endif

    <meta property="og:type" content="website" />
    <meta property="og:country-name" content="Italy" />
    <meta property="og:email" content="{{ env('MAIL_FROM_ADDRESS') }}" />
    <meta property="og:locale" content="it_IT" />
    <meta property="og:description" content="{{ $pagedescription }}" />

    <meta name="twitter:title" content="{{ env('APP_NAME') }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:url" content="{{ env('APP_URL') }}" />

    @if(file_exists(public_path('/images/tw_' . $cityname . '.png')))
        <meta property="og:image" content="{{ env('APP_URL') }}/images/tw_{{ $cityname }}.png" />
    @else
        <meta property="og:image" content="{{ env('APP_URL') }}/images/tw.png" />
    @endif

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

                        <a class="navbar-brand" href="{{ url('/') }}"></a>

                        @if(env('HAS_FOOD'))
                            <a class="navbar-brand-food" href="{{ route('food') }}"></a>
                        @endif

                        @if(env('HAS_HOUSE'))
                            <a class="navbar-brand-house" href="{{ route('house') }}"></a>
                        @endif
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <ul class="nav navbar-nav navbar-right primary-2">
                            <li>
                                @if (Auth::guest())
                                    <div class="row top-main-buttons">
                                        <div class="col-md-6 text-right city-title">
                                            <span class="city-name">{{ App\Config::getConf('instance_city') }}</span><br>
                                            <small>
                                                @foreach(json_decode(App\Config::getConf('other_instance_cities')) as $city)
                                                    <a href="{{ $city->url }}">{{ $city->name }}</a>
                                                @endforeach
                                            </small>
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

                            <li><a href="{{ url('progetto') }}">Progetto</a></li>
                            <li><a href="{{ url('come-funziona') }}">Regole</a></li>
                            <li><a href="{{ url('celo') }}">{{ t('Celo') }}</a></li>
                            <li><a href="{{ url('manca') }}">{{ t('Manca') }}</a></li>
                            <li><a href="{{ url('giocatori') }}">{{ t('Giocatori') }}</a></li>
                            <li><a href="{{ url('numeri') }}">{{ t('Vincitori') }}</a></li>
                            <li><a href="{{ url('parlano-di-noi') }}">Parlano di Noi</a></li>
                            <li><a href="{{ url('contatti') }}">Contatti</a></li>
                            <li>Seguici su
                                @if(!empty($social_link = App\Config::getConf('facebook_link')))
                                    <a href="{{ $social_link }}"><img src="{{ url('images/facebook_icon.png') }}" alt="Facebook"></a>
                                @endif
                                @if(!empty($social_link = App\Config::getConf('instagram_link')))
                                    <a href="{{ $social_link }}"><img src="{{ url('images/instagram_icon.png') }}" alt="Instagram"></a>
                                @endif
                                @if(!empty($social_link = App\Config::getConf('youtube_link')))
                                    <a href="{{ $social_link }}"><img src="{{ url('images/youtube_icon.png') }}" alt="Youtube"></a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

		<div class="container">
            <div class="row visible-md visible-lg">
                <div class="col-md-12 primary-2">
                    <span class="tagline">
                        {{ App\Config::getConf('main_tagline') }}
                        <span class="pull-right">
                            seguici su
                            @if(!empty($social_link = App\Config::getConf('facebook_link')))
                                <a href="{{ $social_link }}"><img src="{{ url('images/facebook_icon.png') }}" alt="Facebook"></a>
                            @endif
                            @if(!empty($social_link = App\Config::getConf('instagram_link')))
                                <a href="{{ $social_link }}"><img src="{{ url('images/instagram_icon.png') }}" alt="Instagram"></a>
                            @endif
                            @if(!empty($social_link = App\Config::getConf('youtube_link')))
                                <a href="{{ $social_link }}"><img src="{{ url('images/youtube_icon.png') }}" alt="Youtube"></a>
                            @endif
                        </span>
                    </span>
                </div>
            </div>

            <div class="row visible-md visible-lg">
                <div class="col-md-12">
                    <ul class="main-menu">
                        <li><a href="{{ url('progetto') }}">Progetto</a></li>
                        <li><a href="{{ url('come-funziona') }}">Regole</a></li>
                        <li><a href="{{ url('celo') }}">{{ t('Celo') }}</a></li>
                        <li><a href="{{ url('manca') }}">{{ t('Manca') }}</a></li>
                        <li><a href="{{ url('giocatori') }}">{{ t('Giocatori') }}</a></li>
                        <li><a href="{{ url('numeri') }}">{{ t('Vincitori') }}</a></li>
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

        <div class="container">
            <div class="row">
                <div class="col-md-12 primary-2">
                    <br>
                    <a href="{{ url('privacy') }}">Privacy Policy</a> | <a href="{{ url('contatti') }}">Contatti</a>
                </div>
            </div>
        </div>

        <br/>
    </div>

    <script src="{{ url('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/chosen.jquery.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.it.min.js') }}"></script>
    <script src="{{ url('js/exif.js') }}"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>
    <script src="{{ url('js/mine.js') }}?a={{ $append }}"></script>

    @include('generic.tracking')
</body>
</html>
