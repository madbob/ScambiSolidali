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
                            Il progetto prevede la realizzazione e sperimentazione di un sistema di reperimento e distribuzione di beni di prossimità di varia natura, basato su una rete locale di enti no profit e servizi di prossimità e su una piattaforma informatica che renda possibile l’incrocio della domanda/offerta di beni e servizi di prima necessità, riducendo al minimo l’impegno e i costi di natura logistica, in particolare per quanto concerne  lo stoccaggio, l’immagazzinamento e la distribuzione centralizzata.
                        </p>
                        <p>
                            I beneficiari diretti delle donazioni saranno persone e famiglie svantaggiate, sia in condizione di marginalità cronica, sia in condizione di povertà grigia derivante da eventi traumatici anche recenti, come la perdita di lavoro, la separazione, la malattia.
                        </p>
                    </div>
                    <div class="col-md-6 left-p">
                        <p>
                            Sulla piattaforma i cittadini potranno donare beni materiali, i commercianti potranno donare fondi di magazzino o altri beni in eccesso, i professionisti potranno offrire gratuitamente servizi nei settori della salute e dell’abitare, le associazioni culturali potranno offrire accessi gratuiti a corsi, spettacoli e laboratori.
                        </p>
                        <p>
                            Gli  operatori accreditati ad accedere alla piattaforma fanno parte di una rete di organizzazioni che operano a contatto con persone e famiglie in difficoltà. Si tratta sia di organizzazioni che gestiscono servizi e progetti in ambito socio assistenziale, sia organizzazioni che, pur non avendo una mission esplicitamente sociale, entrano spesso in contatto con persone e famiglie in difficoltà. Saranno accreditati all’uso della piattaforma anche operatori dei servizi sociali pubblici.
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
                        <p class="intro">
                            Un progetto di
                        </p>
                        <p>
                            Ass. Agenzia per lo sviluppo locale di San Salvario ONLUS
                        </p>
                        <p class="intro">
                            Partner
                        </p>
                        <p>
                            Ufficio Pio della Compagnia di San Paolo, Città di Torino - Circoscrizione 8, Città di Torino- Assessorato alle Politiche Sociali, Ass. Asai, Oratorio San Luigi, Ass. Opportunanda, Ass. Mondo di Joele, Ass. Manzoni People, Parrocchia SS.Pietro e Paolo, Coop. Soc. Accomazzi, Ass. Manamanà, Ass. Officina Informatica Libera, Coop. Soc. Triciclo, SPI CGIL Lega 8, Società Cooperativa Sociale Lancillotto, Centro di Ascolto della Parrocchia Patrocinio di San Giuseppe, Centro di Ascolto della Parrocchia Assunzione di Maria Vergine - Lingotto Torino, Commissione Carità del Consiglio Pastorale della Parrocchia Immacolata Concezione e San Giovanni Battista, Istituto Comprensivo "Sandro Pertini", Associazione Articolo 47.
                        </p>
                        <p>
                            Il progetto è sostenuto dalla Compagnia di San Paolo nell’ambito del Bando Fatto per Bene.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
