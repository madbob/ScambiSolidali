<x-larastrap::modal :id="sprintf('company-%s', $company ? $company->id : 'new')" classes="primary-1">
    <div class="row">
        <div class="col">
            <x-larastrap::form baseaction="azienda" :obj="$company">
                <x-larastrap::text name="name" label="Nome" required />
                <x-larastrap::text name="phone" label="Telefono" required />
                <x-larastrap::email name="email" label="E-Mail" required />
                <x-larastrap::text name="website" label="Sito Web" />

                <x-larastrap::field label="Indirizzo">
                    <x-larastrap::hidden name="address" />
                    <x-larastrap::hidden name="coordinates" value="{{ $company ? ($company->lat . ',' . $company->lng) : '' }}" />
                    <div class="map-select" id="company-address-selection-{{ $company ? $company->id : 'new' }}"></div>
                    <div class="form-text">Attenzione: digita un indirizzo e selezionalo dal menu di autocompletamento. Se l'indirizzo non viene completato in questo modo, non sarà possibile risalire alle coordinate desiderate</div>
                </x-larastrap::field>

                <x-larastrap::text name="opening_hours" label="Orari Apertura" />
                <x-larastrap::text name="preferred_hours" label="Orario Ritiro" />
                <x-larastrap::textarea name="notes" label="Note" />

                <x-larastrap::radios name="donation_frequency" label="Donazione" :options="['none' => 'Nessuna', 'weekly' => 'Settimanale', 'monthly' => 'Mensile']" />
            </x-larastrap::form>

            @if($company)
                @if($company->users->isEmpty())
                    <div class="alert alert-info">
                        Non ci sono operatori registrati per questa azienda.
                    </div>
                @else
                    <table class="table">
                        <tbody>
                            @foreach($company->users as $u)
                                <tr>
                                    <td>{{ $u->printableName() }}</td>
                                    <td>{{ $u->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <button class="btn btn-danger" role="button" data-bs-toggle="collapse" href="#destroyCompany-{{ $company->id }}">Elimina</button>
                <div class="collapse py-3" id="destroyCompany-{{ $company->id }}">
                    <x-larastrap::form method="DELETE" :action="route('azienda.destroy', $company->id)" :buttons="[['element' => 'larastrap::sbtn', 'label' => 'Si, elimina', 'attributes' => ['type' => 'submit']]]" keep_buttons>
                        <div class="alert alert-danger">
                            Sei sicuro di voler eliminare questo azienda? Tutte le sue donazioni saranno eliminate.
                        </div>
                    </x-larastrap::form>
                </div>
            @endif
        </div>
    </div>
</x-larastrap::modal>
