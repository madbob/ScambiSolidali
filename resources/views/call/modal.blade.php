<x-larastrap::modal :id="$call ? 'call-' . $call->id : 'new-call'" size="xl" classes="primary-2">
    <div class="row">
        <div class="col">
            <x-larastrap::form baseaction="manca" :obj="$call">
                @if($call)
                    <p>
                        Creato {{ printableDate($call->created_at) }} da {{ $call->user->printableName() }}
                    </p>
                    <br>
                @endif

                <x-larastrap::text name="title" label="Titolo" required />
                <x-larastrap::textarea name="who" label="Chi siamo?" required />
                <x-larastrap::textarea name="what" label="Cosa vogliamo?" required />
                <x-larastrap::textarea name="whom" label="Per chi?" required />
                <x-larastrap::date name="when" label="Scadenza Appello" required />

                @include('category.selector', [
                    'orientation' => 'horizontal',
                    'selected' => $call ? $call->category : null,
                    'type' => 'all',
                    'direct_response' => true
                ])

                <x-larastrap::textarea name="notes" label="Note (private, visualizzate solo agli operatori)" />
                <x-larastrap::radiolist name="status" label="Stato" :options="['draft' => 'Bozza (non visibile pubblicamente)', 'open' => 'Pubblicato', 'closed' => 'Chiuso', 'archived' => 'Archiviato']" />
            </x-larastrap::form>
        </div>
    </div>

    @if($call && $call->donations()->count() != 0)
        <div class="row">
            <div class="col">
                <hr/>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Utente</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($call->donations as $item)
                                <tr>
                                    <td>{{ ucwords(strftime('%d/%m/%G', strtotime($item->updated_at))) }}</td>
                                    <td>{{ $item->user->printableName() }}</td>
                                    <td><a href="{{ route('celo.index', ['show' => $item->id]) }}">Visualizza</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</x-larastrap::modal>
