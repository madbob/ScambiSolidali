@extends('layouts.app')

@section('title', 'Il Progetto')

@section('content')
    <div class="project">
        <div class="row primary-1">
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
                <div class="row">
                    <div class="col-md-6 right-p">
                        <p>
                            Il progetto prevede un sistema di reperimento e distribuzione di beni di prossimità di varia natura, basato su una rete locale di enti no profit e su una piattaforma informatica che renda possibile l'incrocio della domanda/offerta di beni e servizi di prima necessità, riducendo al minimo l'impegno e i costi di natura logistica, in particolare per quanto concerne lo stoccaggio, l'immagazzinamento e la distribuzione centralizzata.
                        </p>
                        <p>
                            I beneficiari diretti delle donazioni sono persone e famiglie svantaggiate, sia in condizione di marginalità cronica, sia in condizione di povertà grigia derivante da eventi traumatici anche recenti, come la perdita di lavoro, la separazione, la malattia.
                        </p>
                    </div>
                    <div class="col-md-6 left-p">
                        <p>
                            Sulla piattaforma tutti possono donare beni materiali, i commercianti possono donare fondi di magazzino o altri beni in eccesso, i professionisti possono offrire gratuitamente servizi nei settori della salute e dell'abitare, le associazioni culturali possono offrire accessi gratuiti a corsi, spettacoli e laboratori.
                        </p>
                        <p>
                            Gli operatori accreditati ad accedere alla piattaforma fanno parte di una rete di organizzazioni che operano a contatto con persone e famiglie in difficoltà. Si tratta sia di organizzazioni che gestiscono servizi e progetti in ambito socio assistenziale, sia organizzazioni che, pur non avendo una mission esplicitamente sociale, entrano spesso in contatto con persone e famiglie in difficoltà. Sono accreditati all’uso della piattaforma anche operatori dei servizi sociali pubblici.
                        </p>
                        <p>
                            Per maggiori dettagli sul funzionamento visita <a href="/come-funziona">questa pagina</a>.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 right-p">
                        <p class="border-bottom">
                            &nbsp;
                        </p>
                    </div>
                    <div class="col-md-6 left-p">
                        <p class="border-bottom">
                            &nbsp;
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 credits">
                        {!! App\Config::getConf('full_credits') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
