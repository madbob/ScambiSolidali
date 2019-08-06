@extends('layouts.app')

@section('title', 'Casa')

@section('content')
    <div class="house">
        <div class="row primary-3">
            <div class="pagetitle">
                <span>CASA</span>
            </div>

            <div class="col-md-3">
                <div class="common-card">
                    <div class="card-main image-frame" style="background-image: url('{{ url('images/categories/affitti.svg') }}')">
                        &nbsp;
                    </div>
                    <div class="card-footer vert-align">
                        <p>
                            CASA
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
                <p>
                    CERCHIAMO APPARTAMENTI IN AFFITTO, PREFERIBILMENTE IN CITTA', PER OSPITARE FAMIGLIE PRESE IN CARICO DAL PROGETTO "TO HOME, VERSO CASA".
                </p>
                <p>
                    <b>Il progetto "To Home, verso casa" accompagna famiglie, che attraversano un momento di fragilità, nella ricerca e nel raggiungimento dell'autonomia abitativa e lavorativa attraverso azioni di carattere sociale, formativo, educativo per la durata di 18 mesi.</b>
                </p>
                <p>
                    Per alcune famiglie, <b>il progetto prevede un percorso di accompagnamento nelle azioni di reperimento di nuove collocazioni abitative sul mercato privato a costi di locazione sostenibili, valutando sia sistemazioni transitorie sia più a lungo termine</b>, il tutto in un'ottica inclusiva e di collaborazione con il proprietario/locatario.
                </p>
                <p>
                    Un lavoro di equipe prevede un affiancamento graduale e costante dei nuclei, garantendo azioni di supporto, monitoraggio e mediazione nelle differenti situazioni.
                </p>
                <p>
                    Le famiglie To Home vengono supportate con dei percorsi personalizzati per favorirne l'inclusione sociale e occupazionale e per stabilizzare nel tempo la loro condizione abitativa.
                </p>
                <p>
                    <b>Il progetto mette a disposizione misure di sostegno economico, attraverso contributi per le spese dell'affitto, per utenze domestiche e a copertura di eventuali morosità.</b>
                </p>
                <p>
                    <b>A supporto di una buona riuscita del percorso di autonomia abitativa, To Home attiva una serie di azioni formative, per i beneficiari, rispetto a tematiche dell'abitare</b>, quali sportello di educazione finanziaria per una corretta gestione economica del budget familiare, assistenza alla stipula di contratti di locazione e al disbrigo di aspetti burocratico/amministrativi.
                </p>
                <p>
                    Se vuoi avere maggiori informazioni sul progetto scrivi a <a href="mailto:segreteria@agenzia.sansalvario.org">segreteria@agenzia.sansalvario.org</a>
                </p>
                <p>
                    <b>COME FUNZIONA: Se hai un appartamento che vorresti dare in locazione, rispondi a uno dei nostri appelli della categoria "Affitti" che trovi su <a href="{{ url('manca') }}">{{ url('manca') }}</a> e ti contatteremo.</b>
                </p>
                <p>
                    Il progetto <b>"To Home, verso casa"</b> si inserisce all'interno dell'Asse 3, Servizi per l'inclusione sociale del Programma Operativo Nazionale Città Metropolitane – PON Metro Torino 2014-2020, con l'obiettivo specifico di contrastare il disagio abitativo di popolazione nella fascia debole.
                </p>
                <p>
                    <i>Il gruppo di lavoro è formato da Kairos Mestieri, Coop Terra Mia, Coop Liberi Tutti e Agenzia per lo sviluppo locale di San Salvario.</i>
                </p>
            </div>
        </div>
    </div>
@endsection
