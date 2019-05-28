@extends('layouts.food')

@section('title', 'Il Progetto')

@section('content')
    <div class="project">
        <div class="row primary-6">
            <div class="pagetitle">
                <span>IL PROGETTO</span>
            </div>

            <div class="col-md-3">
                <div class="common-card">
                    <div class="card-main image-frame" style="background-image: url('{{ url('images/categories/casa_elettrodomestici.svg') }}')">
                        &nbsp;
                    </div>
                    <div class="card-footer vert-align">
                        <p>
                            {{ env('APP_NAME') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
                <div class="col-md-12">
                    <h4>SMETTERE DI BUTTARE VIA IL CIBO AVANZATO? SI PUO’ FARE</h4>
                    <p>
                        Recuperare il cibo avanzato è oggi una possibilità prevista dalla legge, nonché il metodo più semplice per fare qualcosa di concreto contro lo spreco alimentare.
                    </p>
                    <p>
                        Se a fine giornata lavorativa hai delle eccedenze che non puoi più vendere o che semplicemente vuoi regalare, dillo a celocelo FOOD.
                    </p>
                    <p>
                        Celocelo FOOD nasce dall’esperienza e dall’unione della piattaforma celocelo con Equoevento Onlus: due realtà specializzate nel recupero e redistribuzione delle eccedenze. Un sistema intuitivo, facile e gratuito per aiutarti a non sprecare.
                    </p>

                    <h4>VANTAGGI PER CHI DONA E PER CHI RICEVE</h4>
                    <p>
                        La donazione delle eccedenze alimentari gode oggi della possibilità di SGRAVI FISCALI. Celocelo FOOD è in grado di fornirvi tutta la documentazione necessaria per usufruirne.<br>
                        È sufficiente collegarsi al sito di celocelo FOOD e segnalare i prodotti di cui hai un’eccedenza. Ti contatteremo per venire a ritirare direttamente nel tuo negozio poco dopo la chiusura.
                    </p>
                    <p>
                        I riceventi delle tue donazioni sono operatori accreditati del mondo del sociale che gestiscono persone e famiglie in situazione di marginalità cronica, o in condizione di povertà grigia, ovvero in seguito a un evento traumatico come la perdita del lavoro, la separazione famigliare, la malattia. Persone per cui le tue donazioni alimentari fanno certamente la differenza.
                    </p>

                    <h4>HAI DEL CIBO INVENDUTO?</h4>
                    <p>
                        Se a fine giornata lavorativa pensi di avere delle eccedenze che non puoi più vendere o che semplicemente vuoi regalare, scrivi a: segreteria@agenzia.sansalvario.org
                    </p>
                </div>

                <div class="col-md-12">
                    <p class="border-bottom">
                        &nbsp;
                    </p>
                </div>

                <div class="col-md-12 credits">
                    {!! App\Config::getConf('food_full_credits') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
