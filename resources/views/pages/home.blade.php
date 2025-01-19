@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <div class="home">
        <div class="row primary-3">
            <div class="col bg-color header-claim">
                <p>
                    Non si butta via niente:<br/>quello che non serve a te puoi darlo a {{ env('APP_NAME') }}
                </p>

                <p class="small-link">
                    <a class="other-arrowlink" href="{{ route('pages.working') }}">Come funziona</a>
                </p>

                <?php $video_link = App\Config::getConf('video_link') ?>
                @if(!empty($video_link))
                    <iframe width="100%" height="315" src="{{ $video_link }}" frameborder="0" allowfullscreen title="Video di presentazione"></iframe>
                @else
                    <img class="home-cover img-fluid" src="{{ App\Config::getConf('cover_link') }}" alt="{{ env('APP_NAME') }}">
                @endif
            </div>
        </div>

        <div class="row spaced-below">
            <div class="col-md-6 primary-1">
                <div class="row mb-4">
                    <div class="d-none d-md-flex align-items-center col-5 tb-border">
                        <p class="txt-color">
                            quante cose hai che non ti servono più?
                        </p>
                    </div>
                    <div class="col-md-7 px-4">
                        <div class="common-card">
                            <div class="card-main vert-align bg-color">
                                <p class="text-uppercase">
                                    {{ t('Celo!') }}
                                </p>
                            </div>
                            <div class="card-footer vert-align">
                                <p>
                                    <a href="{{ route('celo.index') }}">{{ t('Inserisci il tuo annuncio') }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 primary-2">
                <div class="row mb-4">
                    <div class="col-md-7 px-4">
                        <div class="common-card">
                            <div class="card-main vert-align bg-color">
                                <p class="text-uppercase">
                                    {{ t('Manca!') }}
                                </p>
                            </div>
                            <div class="card-footer vert-align">
                                <p>
                                    <a href="{{ route('manca.index') }}">{{ t('Ci puoi aiutare?') }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-flex col-5 tb-border align-items-center text-end">
                        <p class="txt-color">
                            ci servono delle cose, magari le hai tu?
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row primary-2">
            <div class="col bg-color header-claim">
                <p>
                    {!! App\Config::getConf('homebox_title') !!}
                </p>

                <div class="d-none d-md-block">
                    <div class="double-side">
                        <div class="col-md-4 text-right">
                            donare un oggetto<br/>in buono stato<br/>che non utilizzi più
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="row">
                                <div class="col-md-6 right-border">
                                    <img src="{{ Vite::asset('resources/images/oggetti.svg') }}" alt="Dona oggetti">
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ Vite::asset('resources/images/tempo.svg') }}" alt="Dona tempo">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-left">
                            offrire un po’ del tuo tempo<br/>o una tua competenza
                        </div>
                    </div>
                </div>
                <div class="d-block d-md-none">
                    <div class="row spaced-below">
                        <div class="col">
                            <img class="img-fluid" src="{{ Vite::asset('resources/images/oggetti.svg') }}" alt="Dona oggetti">
                        </div>
                        <div class="col">
                            <p>
                                donare un oggetto<br/>in buono stato<br/>che non utilizzi più
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <img class="img-fluid" src="{{ Vite::asset('resources/images/tempo.svg') }}" alt="Dona tempo">
                        </div>
                        <div class="col">
                            <p>
                                offrire un po’ del tuo tempo<br/>o una tua competenza
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-none d-md-flex row spaced-below justify-content-between">
            <div class="col-2 primary-1 p-0">
                <p class="top-border"></p>
            </div>
            <div class="col-2 primary-2 p-0">
                <p class="top-border"></p>
            </div>
        </div>

        <div class="row primary-3">
            <div class="col bg-color header-claim">
                <h2>{{ t('Lieto fine') }}</h2>

                <p>
                    {{ t("Vuoi scoprire che fine ha fatto il tuo frigo? Qui ti raccontiamo le storie di successo di") }} {{ env('APP_NAME') }}.
                </p>

                <p class="small-link">
                    <a class="other-arrowlink" href="{{ route('pages.numbers') }}">{{ t('Cosa è successo') }}</a>
                </p>
            </div>
        </div>

        <div class="row footer-credits">
            <div class="col">
                <div class="text-center">
                    @include('customs.' . currentInstance() . '.credits')
                </div>
            </div>
        </div>
    </div>
@endsection
