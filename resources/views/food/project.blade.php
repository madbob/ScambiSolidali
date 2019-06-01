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
                    <div class="card-main image-frame" style="background-image: url('{{ url('images/food-placeholder.svg') }}')">
                        &nbsp;
                    </div>
                    <div class="card-footer vert-align">
                        <p>
                            {{ env('APP_NAME') }} FOOD
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
                <div class="col-md-12">
                    <p>
                        Celocelo Food, un nuovo progetto di recupero di eccedenze alimentari sta partendo!
                    </p>
                    <p>
                        La sfida di Celocelo Food è <strong>recuperare prodotti alimentari in eccedenza, anche freschi e da piccoli esercizi commerciali, e rIdistribuirli in maniera agile, senza stoccaggio e magazzino</strong>, attraverso l'utilizzo di una applicazione digitale.
                    </p>
                    <p>
                        Celocelo Food <strong>non vende nulla</strong>: recupera prodotti perfettamente conservati e consumabili, che rischierebbero di diventare rifiuto e li redistribuisce presso strutture e progetti che hanno in carico persone e famiglie in difficoltà economica.
                    </p>
                    <p>
                        Celocelo Food - realizzato dall'<strong>Agenzia per lo sviluppo locale di San Salvario onlus - Casa del Quartiere San Salvario</strong> e da <strong>Equovento onlus</strong>, in collaborazione con <strong>coop. soc. Stranaidea</strong> e <strong>Officine Informatica Libera</strong> - è uno sviluppo del progetto Celocelo, la piattaforma informatica che rende possibile la donazione e il trasporto di beni materiali a persone e famiglie in difficoltà, attiva su tutto il territorio torinese dal 2017.
                    </p>
                    <p>
                        Sostenuto dalla Compagnia di San Paolo, nell'ambito del bando Fatto per Bene 2018, Celocelo Food intende quindi utilizzare reti, modalità operative e tecnologie già attive in Celocelo, per strutturare due circuiti specifici di recupero e redistribuzione di alimenti freschi e secchi:
                    </p>
                    <ol>
                        <li><strong>un circuito di recupero coinvolgerà piccoli esercizi commerciali</strong>, nell'area di San Salvario e dei quartiere limitrofi;</li>
                        <li>un altro circuito, che partirà in un secondo momento, che coinvolgerà <strong>la grande distribuzione, utilizzando un meccanismo di prenotazione e attribuzione just-in-time dei prodotti alimentari recuperati</strong>.</li>
                    </ol>
                    <p>
                        Gli obiettivi del progetto sono: recuperare prodotti alimentari buoni, garantendone la perfetta conservazione e rIdistribuirli in maniera mirata a chi ne ha davvero bisogno; sensibilizzare gli operatori commerciali ad entrare in una rete di solidarietà e welfare locale; sollecitare i consumatori a orientare le proprie scelte di acquisto presso esercizi commerciali responsabili; attivare volontari che possano farsi carico, nel tempo, delle attività di recupero e redistribuzione.
                    </p>
                    <p>
                        Celocelo Food punta infatti a costruire una rete di esercizi commerciali sensibili ai temi della responsabilità sociale e ambientale, dar loro visibilità, facilitare le donazioni di eccedenze, intercettare e coordinare cittadini attivi che abbiano voglia e motivazione di dedicare un po' del loro tempo libero a queste attività.
                    </p>
                    <p>
                        Celocelo Food sarà presentato il <strong><u>12 giugno 2019, alle ore 11.00</u></strong>, presso <strong>Tomato Backpackers Hotel</strong>, in via Silvio Pellico 11, uno dei primi esercizi commerciali che hanno aderito al progetto.
                    </p>
                    <p>
                        Celocelo Food è alla ricerca di operatori commerciali grandi e piccoli che vogliano aderire al progetto. Per farlo basta rivolgersi agli uffici dell'ass. Agenzia per lo sviluppo locale di San Salvario onlus, presso:
                    </p>
                    <p>
                        Casa del Quartiere di San Salvario - via Morgari 14 - Torino<br>
                        E segreteria@agenzia.sansalvario.org<br>
                        T 0116686772
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
