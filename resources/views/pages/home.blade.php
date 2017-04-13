@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <div class="home">
        <div class="row primary-3">
            <div class="col-md-12 bg-color header-claim">
                <p>
                    Non si butta via niente:<br/>quello che non serve a te puoi darlo a Celocelo
                </p>

                <p class="small-link">
                    <a class="other-arrowlink" href="{{ url('come-funziona') }}">Come funziona</a>
                </p>
            </div>
        </div>

        <div class="row spaced-below">
            <div class="col-md-6 primary-1">
                <div class="col-md-4 tb-border vert-align">
                    <p class="txt-color">
                        quante cose hai, che non ti servono più?
                    </p>
                </div>
                <div class="col-md-offset-1 col-md-7 left-p">
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
                <div class="col-md-7 right-p">
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
                    <strong>Celocelo</strong> è una piattaforma che migliora la vita<br/>delle persone in difficoltà che ti stanno attorno. Ti permette di:
                </p>

                <div class="double-side">
                    <div class="col-md-4 text-right">
                        donare un oggetto<br/>in buono stato ma<br/>che non utilizzi più
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="col-md-6">
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
                    Vuoi scoprire che fine ha fatto il tuo frigo? Qui ti raccontiamo  le storie di successo di Celocelo.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
@endsection
