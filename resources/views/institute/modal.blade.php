<x-larastrap::modal :id="sprintf('institute-%s', $institute ? $institute->id : 'new')" size="xl" classes="primary-1">
    <div class="row">
        <div class="col">
            <x-larastrap::form baseaction="ente" :obj="$institute">
                <x-larastrap::text name="name" label="Nome" />
                <x-larastrap::text name="website" label="Sito Web" />

                @if(env('HAS_FOOD', false))
                    <x-larastrap::check inline name="food" label="Abilitato per Food" />
                @endif

                <x-larastrap::field label="Indirizzo">
                    <x-larastrap::hidden name="address" />
                    <x-larastrap::hidden name="coordinates" value="{{ $institute ? ($institute->lat . ',' . $institute->lng) : '' }}" />
                    <div class="map-select" id="institute-address-selection-{{ $institute ? $institute->id : 'new' }}"></div>
                    <div class="form-text">Attenzione: digita un indirizzo e selezionalo dal menu di autocompletamento. Se l'indirizzo non viene completato in questo modo, non sarà possibile risalire alle coordinate desiderate</div>
                </x-larastrap::field>

                @if($institute == null)
                    <input type="hidden" name="code" value="{{ Illuminate\Support\Str::random(10) }}">
                @else
                    <x-larastrap::text name="code" label="Codice" help="Questo è il codice che gli operatori devono usare nell'apposito pannello di registrazione per essere accreditati a questo ente" readonly />
                @endif

                <x-larastrap::text name="transport_mail" label="Indirizzo EMail per Trasporto" help="Se specificato, quando un operatore di questo Ente chiede il trasporto di una donazione l'email di notifica viene inviata qui anziché agli amministratori" />
            </x-larastrap::form>

            @if($institute)
                @if($institute->users->isEmpty())
                    <div class="alert alert-info">
                        Non ci sono operatori registrati per questa associazione.
                    </div>
                @else
                    <table class="table">
                        <tbody>
                            @foreach($institute->users as $u)
                                <tr>
                                    <td>{{ $u->printableName() }}</td>
                                    <td>{{ $u->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <button class="btn btn-danger" role="button" data-bs-toggle="collapse" href="#destroyUser-{{ $institute->id }}">Elimina</button>
                <div class="collapse py-3" id="destroyUser-{{ $institute->id }}">
                    <x-larastrap::form method="DELETE" :action="route('ente.destroy', $institute->id)" :buttons="[['element' => 'larastrap::sbtn', 'label' => 'Si, elimina', 'attributes' => ['type' => 'submit']]]" keep_buttons>
                        <div class="alert alert-danger">
                            Sei sicuro di voler eliminare questa associazione?
                        </div>
                    </x-larastrap::form>
                </div>
            @endif
        </div>
    </div>
</x-larastrap::modal>
