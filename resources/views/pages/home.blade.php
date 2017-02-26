@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Cos’è?</h3>

            <p>
                Celocelo è una piattaforma che migliora la vita delle persone in difficoltà che ti stanno attorno.
            </p>
            <p>
                Ti permette di:
            </p>
            <ul>
                <li>donare un oggetto in buono stato ma che non utilizzi più</li>
                <li>offrire una competenza professionale e un po’ del tuo  tempo a disposizione</li>
            </ul>

            <h3>A chi si rivolge?</h3>

            <p>
                La piattaforma è rivolta a tutte le persone che hanno piacere di donare oggetti di varia natura, ai commercianti che possono donare fondi di magazzino o altri beni in eccesso, ai professionisti che possono offrire gratuitamente servizi nei settori della salute e dell'abitare, a tutte le associazioni che possono donare accessi gratuiti a corsi, spettacoli e laboratori.
            </p>
            <p>
                Le donazioni aiutano persone e famiglie in condizione di povertà o che attraversano un periodo di difficoltà dovuta a eventi traumatici come la perdita di lavoro, una separazione, una malattia improvvisa.
            </p>
            <p>
                La piattaforma è uno strumento che aiuta il lavoro degli operatori dei servizi che sostengono le persone in difficoltà.
            </p>
            <p>
                A beneficiare del progetto, sono anche le persone in condizione di disoccupazione e povertà impiegate nelle attività di logistica.
            </p>

            <h3>Come funziona?</h3>

            <h4>Sei un donatore?</h4>
            <p>
                Registrati sul sito, scegli la categoria del tuo oggetto, descrivilo, aggiungi delle foto e premi Invio!
            </p>
            <p>
                Inoltre puoi consultare la bacheca dei nostri appelli, saprai cosa stiamo cercando.
            </p>
            <p>
                Se l’oggetto che hai inserito non viene richiesto da nessun operatore, passato un mese puoi scegliere di farlo valutare a Triciclo (link), nel caso in cui fossero interessati verrà preso in carico da loro.
            </p>

            <h4>Sei un operatore?</h4>
            <p>
                Registrati sul sito, scegli la categoria del bene di cui hai bisogno, segnala il tuo interesse e contatta il donatore!
            </p>
            <p>
                Se hai una richiesta specifica, puoi inserire un appello!
            </p>

            <h4>Come avviene la donazione?</h4>

            <p>
                La piattaforma ha anche la funzione di ridurre l'impegno logistico per quanto concerne la selezione, stoccaggio, immagazzinamento e distribuzione centralizzata.
            </p>

            <p>
                Quello che doni sarà recuperato nel luogo e nei tempi che indicherai:
            </p>
            <ul>
                <li>da chi ne beneficia aiutato dall’operatore sociale che ha accettato la donazione e che funge da tutor e garante</li>
                <li>dall’operatore sociale che ha accettato la donazione</li>
            </ul>

            <p>
                Puoi sempre consegnare tu il tuo dono all’operatore sociale interessato se è più facile per te.
            </p>

            <p>
                Se non è possibile recuperare la tua donazione nei modi indicati sopra si atttverà un servizio di logistica dedicato. Ad esempio quando le caratteristiche del bene donato (ad esempio una lavatrice) o del donatore (ad esempio una persona anziana, sola) saranno di ostacolo alla autonoma organizzazione del recupero.
            </p>

            <p>
                Il servizio di logistica dedicato si avvale dell’impegno di persone disoccupate, retribuite attraverso l’utilizzo di voucher.
            </p>

            <p>
                Collaboriamo con la cooperativa sociale Triciclo, per il recupero di doni che richiedano un furgone.
            </p>
        </div>
        <div class="col-md-4 text-center">
            <a href="{{ url('donazione/create') }}" class="btn btn-default btn-lg">Dona adesso</a>
        </div>
    </div>

    <?php $calls = App\Call::where('status', 'open')->get() ?>
    @if($calls->isEmpty() == false)
        <div class="row">
            <ul class="list-group">
                @foreach($calls as $call)
                    <li class="list-group-item">
                        <span class="badge">{{ printableDate($call->created_at) }}</span>
                        <h3 class="list-group-item-heading">{{ $call->title }}</h3>

                        <h4>Chi siamo?</h4>
                        <p>{!! nl2br($call->who) !!}</p>

                        <h4>Cosa cerchiamo?</h4>
                        <p>{!! nl2br($call->what) !!}</p>

                        <h4>Per chi è?</h4>
                        <p>{!! nl2br($call->whom) !!}</p>

                        <h4>Entro quando?</h4>
                        <p>{!! nl2br(printableDate($call->when)) !!}</p>

                        <a class="btn btn-default pull-right" href="{{ url('donazione/create?call=' . $call->id) }}">Rispondi all'appello!</a>
                        <div class="clearfix"></div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
