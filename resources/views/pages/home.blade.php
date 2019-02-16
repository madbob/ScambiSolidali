@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    @if($currentuser)
        @foreach($currentuser->companies as $company)
            @foreach($company->recurrings()->where('closed', false)->where('filled', false)->get() as $recurring)
                <div class="alert alert-info">
                    Devi ancora compilare la scheda di donazione {{ $recurring->company->donation_frequency == 'weekly' ? 'settimanale' : 'mensile' }} per {{ $recurring->company->name }}!<br>
                    <a href="{{ $recurring->link }}">Clicca qui per procedere!</a>.
                </div>
            @endforeach
        @endforeach
    @endif

    <div class="home">
        <div class="row primary-3">
            <div class="col-md-12 bg-color header-claim">
                <p>
                    Non si butta via niente:<br/>quello che non serve a te puoi darlo a {{ env('APP_NAME') }}
                </p>

                <p class="small-link">
                    <a class="other-arrowlink" href="{{ url('come-funziona') }}">Come funziona</a>
                </p>

                <iframe width="560" height="315" src="{{ App\Config::getConf('video_link') }}" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="row spaced-below">
            <div class="col-md-6 primary-1">
                <div class="col-md-4 tb-border vert-align">
                    <p class="txt-color">
                        quante cose hai, che non ti servono più?
                    </p>
                </div>
                <div class="col-md-offset-1 col-md-7 both-p">
                    <div class="common-card">
                        <div class="card-main vert-align bg-color">
                            <p>
                                CELO!
                            </p>
                        </div>
                        <div class="card-footer vert-align">
                            <p>
                                <a href="{{ url('celo') }}">Inserisci il tuo annuncio</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 primary-2">
                <div class="col-md-7 both-p">
                    <div class="common-card">
                        <div class="card-main vert-align bg-color">
                            <p>
                                MANCA!
                            </p>
                        </div>
                        <div class="card-footer vert-align">
                            <p>
                                <a href="{{ url('manca') }}">Ci puoi aiutare?</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-offset-1 col-md-4 tb-border vert-align text-right">
                    <p class="txt-color">
                        ci servono delle cose, magari le hai tu?
                    </p>
                </div>
            </div>
        </div>

        <div class="row primary-2">
            <div class="col-md-12 bg-color header-claim">
                <p>
                    <strong>{{ env('APP_NAME') }}</strong> è una piattaforma che migliora la vita<br/>delle persone in difficoltà che ti stanno attorno. Ti permette di:
                </p>

                <div class="double-side">
                    <div class="col-md-4 text-right">
                        donare un oggetto<br/>in buono stato ma<br/>che non utilizzi più
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="col-md-6 right-border">
                            <img src="{{ url('images/oggetti.svg') }}">
                        </div>
                        <div class="col-md-6">
                            <img src="{{ url('images/tempo.svg') }}">
                        </div>
                    </div>
                    <div class="col-md-4 text-left">
                        offrire un po’ del tuo tempo<br/>o una tua competenza professionale
                    </div>
                </div>
            </div>
        </div>

        <div class="row spaced-below">
            <div class="col-md-6 primary-1">
                <div class="col-md-4 top-border">
                </div>
                <div class="col-md-offset-1 col-md-7 left-p">
                </div>
            </div>
            <div class="col-md-6 primary-2">
                <div class="col-md-7 right-p">
                </div>
                <div class="col-md-offset-1 col-md-4 top-border">
                </div>
            </div>
        </div>

        <div class="row primary-3">
            <div class="col-md-12 bg-color header-claim">
                <h2>Lieto fine</h2>

                <p>
                    Vuoi scoprire che fine ha fatto il tuo frigo? Qui ti raccontiamo le storie di successo di {{ env('APP_NAME') }}.
                </p>

                <p class="small-link">
                    <a class="other-arrowlink" href="{{ url('numeri') }}">Cosa è successo</a>
                </p>
            </div>
        </div>

        <div class="row footer-credits">
            <div class="col-md-12">
                <div class="text-center">
                    {!! App\Config::getConf('credits') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
