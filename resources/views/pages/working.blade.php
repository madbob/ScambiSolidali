@extends('layouts.app')

@section('title', 'Come Funziona')

@section('content')
    <div class="working">
        <div class="row primary-2">
            <div class="pagetitle">
                <span>COME FUNZIONA</span>
            </div>
        </div>

        <div class="row primary-1">
            <div class="col-md-3">
                <div class="button screaming-border">
                    <span>SEI UN PRIVATO?</span>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-1">
                <h4>Hai un oggetto che non usi più<br/>o vuoi donare un po' del tuo tempo?</h4>

                <p>
                    <a class="arrowlink" href="{{ url('celo') }}">vai su CELO!</a>
                </p>
                <p>
                    Registrati sul sito, scegli la categoria del tuo oggetto, descrivilo, aggiungi delle foto e premi Invio! Oppure descrivi le tue competenze e la tua disponibilità di tempo!<br/>
                    Puoi inoltre consultare la bacheca dei nostri appelli su <a class="arrowlink" href="{{ url('manca') }}">MANCA</a>, saprai cosa stiamo cercando.<br/>
                    Se l’oggetto che hai inserito non viene richiesto da nessun operatore, passato un mese puoi scegliere di farlo valutare a <a href="htp://www.triciclo.com/">Triciclo</a>, nel caso in cui fossero interessati al tuo oggetto verrà preso in carico da loro.
                </p>
            </div>
        </div>

        <hr class="black">

        <div class="row primary-2">
            <div class="col-md-3">
                <div class="button screaming-border">
                    <span>SEI UN OPERATORE?</span>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-1">
                <p>
                    Registrati sul sito, vai su <a class="arrowlink" href="{{ url('celo') }}">CELO</a> e scegli la categoria del bene di cui hai bisogno, segnala il tuo interesse e contatta il donatore!<br/>
                    Se hai una richiesta specifica, vai su <a class="arrowlink" href="{{ url('manca') }}">MANCA</a> per inserire un appello!
                </p>
            </div>
        </div>

        <hr class="black">

        <div class="row primary-3">
            <div class="col-md-3">
                <div class="button screaming-border">
                    <span>COME AVVIENE LA DONAZIONE?</span>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-1">
                <h4>La piattaforma ha anche la funzione di ridurre l'impegno logistico per quanto concerne la selezione, stoccaggio, immagazzinamento e distribuzione centralizzata.</h4>

                <p>
                    <strong>Il bene sarà recuperato nel luogo e nei tempi che indicherai:</strong><br/>
                    / da chi ne beneficia aiutato dall’operatore sociale che ha accettato la donazione e che funge da tutor e garante<br/>
                    / dall’operatore sociale che ha accettato la donazione<br/>
                    <strong>Puoi sempre consegnare tu</strong> il tuo bene all’operatore sociale interessato se è più facile per te.<br/>
                    Se non è possibile recuperare il bene nei modi indicati sopra si attiverà un <strong>servizio di logistica</strong> dedicato. Per esempio quando le caratteristiche del bene donato (ad esempio una lavatrice) o del donatore (ad esempio una persona anziana, sola) saranno di ostacolo alla autonoma organizzazione del recupero.<br/>
                    Il servizio di logistica dedicato si avvale dell’impegno di persone disoccupate. Collaboriamo con la cooperativa sociale Triciclo per il recupero di doni che richiedano un furgone.
                </p>
            </div>
        </div>
    </div>
@endsection
