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
                    Registrati sul sito, scegli la categoria, descrivi il tuo oggetto, aggiungi delle foto e premi Invio! Oppure descrivi le tue competenze e la tua disponibilità di tempo!<br/>
                </p>
                <p>
                    <a class="arrowlink" href="{{ url('manca') }}">vai su MANCA!</a>
                </p>
                <p>
                    Consulta la bacheca dei nostri appelli, scoprirai  cosa stiamo cercando.
                </p>
                <p>
                    Tutti gli oggetti saranno destinati  a persone in difficoltà economica individuate dalle <a href="{{ url('giocatori') }}">organizzazioni aderenti</a>.
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
                    Se vuoi aderire al progetto ed essere accreditato all’uso della piattaforma scrivi a <a href="mailto:segreteria@agenzia.sansalvario.org">segreteria@agenzia.sansalvario.org</a>.
                </p>
                <p>
                    Possono aderire enti no profit che operano a favore di persone in difficoltà.
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
                <ol>
                    <li>Registrati sul sito</li>
                    <li>Inserisci il tuo annuncio</li>
                    <li>Aspetta di essere contattato</li>
                    <li>Prendi accordi per il trasporto</li>
                </ol>

                <p>
                    I beni e il tempo donati andranno a favore di persone in difficoltà, potrai conoscere l’esito della donazione tramite l'Associazione che l'ha gestita.
                </p>
                <p>
                    Potrai consegnare direttamente il bene oppure verremo noi da te a ritirarlo.
                </p>
                <p>
                    Se l'oggetto che hai inserito non viene richiesto da nessun operatore, passato un mese puoi scegliere di farlo valutare dalla cooperativa sociale <a href="http://www.triciclo.com/">Triciclo</a>, nel caso in cui fossero interessati al tuo oggetto verrà preso in carico da loro.
                </p>
            </div>
        </div>
    </div>
@endsection
