<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pagetitle }}</title>
    <meta name="Description" content="{{ App\Config::getConf('main_tagline') }}">

    <?php

    if (isset($custom_js) == false) {
        $custom_js = [];
    }

    if (isset($custom_css) == false) {
        $custom_css = [];
    }

    ?>

    @foreach($custom_css as $ccss)
        <link rel="stylesheet" href="{{ $ccss }}" type="text/css" />
    @endforeach

    @vite([
        'resources/sass/' . currentInstance() . '.scss',
        'resources/js/app.js'
    ])

    <meta name="theme-color" content="#FFF"/>
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:title" content="{{ $pagetitle }}" />

    <?php $cityname = currentInstance() ?>

    @if(file_exists(public_path('/images/fb_' . $cityname . '.png')))
        <meta property="og:image" content="{{ Vite::asset('resources/images/fb_' . $cityname . '.png') }}" />
    @else
        <meta property="og:image" content="{{ Vite::asset('resources/images/fb.png') }}" />
    @endif

    <meta property="og:type" content="website" />
    <meta property="og:country-name" content="Italy" />
    <meta property="og:email" content="{{ env('MAIL_ADMIN') }}" />
    <meta property="og:locale" content="it_IT" />
    <meta property="og:description" content="{{ $pagedescription }}" />

    <meta name="twitter:title" content="{{ env('APP_NAME') }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:url" content="{{ env('APP_URL') }}" />

    @if(file_exists(public_path('/images/tw_' . $cityname . '.png')))
        <meta property="og:image" content="{{ Vite::asset('resources/images/tw_' . $cityname . '.png') }}" />
    @else
        <meta property="og:image" content="{{ Vite::asset('resources/images/tw.png') }}" />
    @endif

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <div class="container d-none d-md-block">
            <div class="row justify-content-between align-items-center py-2">
                <div class="col">
                    <a class="navbar-brand" href="{{ route('home') }}" title="Homepage {{ config('app.name') }}">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/logo_' . $cityname . '.png') }}">
                    </a>

                    @if(env('HAS_FOOD'))
                        <a class="navbar-brand-food" href="{{ route('food') }}"></a>
                    @endif

                    @if(env('HAS_HOUSE'))
                        <a class="navbar-brand-house" href="{{ route('house') }}"></a>
                    @endif
                </div>

                <div class="col-auto navbar-right primary-2">
                    @if (Auth::guest())
                        <div class="row top-main-buttons">
                            <div class="col text-end city-title">
                                <span class="city-name">{{ App\Config::getConf('instance_city') }}</span><br>
                                <small>
                                    @foreach(json_decode(App\Config::getConf('other_instance_cities')) as $city)
                                        <a href="{{ $city->url }}">{{ $city->name }}</a>
                                    @endforeach
                                </small>
                            </div>
                            <div class="col left-border">
                                <a href="{{ route('register') }}">Registrati</a><br>
                                <a href="{{ route('login') }}">Login</a>
                            </div>
                        </div>
                    @else
                        <div class="row top-main-buttons">
                            <div class="col text-end city-title">
                                <span class="city-name">{{ App\Config::getConf('instance_city') }}</span>
                            </div>
                            <div class="col left-border">
                                <span>Ciao, {{ $currentuser->name }}<br></span>

                                <a href="{{ route('donation.mine') }}">Il Mio Profilo</a><br>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col primary-2">
                    <span class="tagline">
                        {{ App\Config::getConf('main_tagline') }}
                        <span class="float-end">
                            seguici su
                            @if(!empty($social_link = App\Config::getConf('facebook_link')))
                                <a href="{{ $social_link }}"><img src="{{ Vite::asset('resources/images/facebook_icon.png') }}" alt="Facebook"></a>
                            @endif
                            @if(!empty($social_link = App\Config::getConf('instagram_link')))
                                <a href="{{ $social_link }}"><img src="{{ Vite::asset('resources/images/instagram_icon.png') }}" alt="Instagram"></a>
                            @endif
                            @if(!empty($social_link = App\Config::getConf('youtube_link')))
                                <a href="{{ $social_link }}"><img src="{{ Vite::asset('resources/images/youtube_icon.png') }}" alt="Youtube"></a>
                            @endif
                        </span>
                    </span>
                </div>
            </div>

            <div class="row d-none d-md-flex">
                <div class="col">
                    <ul class="main-menu">
                        <li><a href="{{ route('pages.project') }}">Progetto</a></li>
                        <li><a href="{{ route('pages.working') }}">Regole</a></li>
                        <li><a href="{{ route('celo.index') }}">{{ t('Celo') }}</a></li>
                        <li><a href="{{ route('manca.index') }}">{{ t('Manca') }}</a></li>
                        <li><a href="{{ route('giocatori.index') }}">{{ t('Giocatori') }}</a></li>
                        <li><a href="{{ route('pages.numbers') }}">{{ t('Vincitori') }}</a></li>
                        <li><a href="{{ route('parlano-di-noi.index') }}">Parlano di Noi</a></li>
                        <li><a href="{{ route('contacts') }}">{{ t('Contatti') }}</a></li>
                    </ul>
                </div>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>

        <div class="container d-block d-md-none mb-4">
            <div class="row justify-content-between align-items-center py-2">
                <div class="col">
                    <a class="navbar-brand" href="{{ route('home') }}" title="Homepage {{ config('app.name') }}">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/logo_' . $cityname . '.png') }}">
                    </a>
                </div>
                <div class="col text-end">
                    <a class="btn btn-light" data-bs-toggle="collapse" href="#mobileMenu" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                </div>
            </div>

            <div class="collapse" id="mobileMenu">
                @if(Auth::guest())
                    <ul class="main-menu">
                        <li><a href="{{ route('register') }}">Registrati</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                    </ul>
                @else
                    <ul class="main-menu">
                        <li><a href="{{ route('donation.mine') }}">Il Mio Profilo</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                    </ul>
                @endif

                <ul class="main-menu">
                    <li><a href="{{ route('pages.project') }}">Progetto</a></li>
                    <li><a href="{{ route('pages.working') }}">Regole</a></li>
                    <li><a href="{{ route('celo.index') }}">{{ t('Celo') }}</a></li>
                    <li><a href="{{ route('manca.index') }}">{{ t('Manca') }}</a></li>
                    <li><a href="{{ route('giocatori.index') }}">{{ t('Giocatori') }}</a></li>
                    <li><a href="{{ route('pages.numbers') }}">{{ t('Vincitori') }}</a></li>
                    <li><a href="{{ route('parlano-di-noi.index') }}">Parlano di Noi</a></li>
                    <li><a href="{{ route('contacts') }}">{{ t('Contatti') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="container">
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
                <div class="col primary-2">
                    <br>
                    <a href="{{ route('pages.privacy') }}">Condizioni generali e Privacy Policy</a> | <a href="{{ route('contacts') }}">Contatti</a>
                </div>
            </div>
        </div>

        <br/>
    </div>

    @foreach($custom_js as $cjs)
        <script src="{{ $cjs }}"></script>
    @endforeach

    @include('generic.tracking')
</body>
</html>
