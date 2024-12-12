<x-larastrap::modal :id="$call->id" classes="primary-2" size="xl">
    <div class="row">
        <div class="col">
            <h4 class="modal-title">{{ $call->category->name }} - {{ $call->title }}</h4>
            <p class="text-muted hidden-xs"><small><br>{{ url('/manca?show=' . $call->id) }}</small></p>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p>{{ $call->who }}</p>
            <p>{{ $call->what }}</p>
            <p>{{ $call->whom }}</p>
            <p>{{ printableDate($call->when) }}</p>

            <hr>

            @if($call->status == 'open')
                @if($currentuser && $call->category->direct_response)
                    <x-larastrap::form :action="route('celo.direct', $call->id)" :buttons="[['element' => 'larastrap::sbtn', 'label' => 'Invia', 'attributes' => ['type' => 'submit']]]">
                        <p>
                            Per questo tipo di appello puoi inviare direttamente un messaggio al richiedente per segnalare la tua disponibilità. Chi ha pubblicato l'appello riceverà i tuoi dati per ricontattarti.
                        </p>

                        <x-larastrap::textarea name="message" label="Messaggio" required rows="10" />
                    </x-larastrap::form>
                @else
                    <a href="{{ url('celo/nuovo/' . ($call->type == 'service' ? 'servizio' : 'oggetto') . '?call=' . $call->id) }}" class="btn btn-default button">
                        <span>Celo!</span>
                    </a>
                @endif
            @else
                <div class="alert alert-danger">
                    Questo appello non è più valido! <a href="{{ route('manca.index') }}">Clicca qui</a> per consultare gli altri appelli ancora aperti.
                </div>
            @endif
        </div>
    </div>
</x-larastrap::modal>
