<x-larastrap::modal :id="sprintf('user-%s', $user ? $user->id : 'new')" size="xl" classes="primary-2">
    <div class="row">
        <div class="col">
            <x-larastrap::form :obj="$user" baseaction="utenti">
                <x-larastrap::text name="name" label="Nome" required />
                <x-larastrap::text name="surname" label="Cognome" required />
                <x-larastrap::text name="phone" label="Telefono" required />

                @if(env('HAS_BIRTHDATE', false))
                    <x-larastrap::date name="birthdate" label="Data di Nascita" />
                @endif

                <x-larastrap::email name="email" label="E-Mail" required />
                <x-larastrap::password name="password" label="Password" help="Lascia vuoto per non modificare la password esistente" />

                <?php

                $selector = [];
                foreach(App\User::existingRoles() as $identifier => $metadata) {
                    $selector[$identifier] = $metadata->label;
                }

                ?>

                <x-larastrap::radiolist name="role" label="Ruolo" :options="$selector" />

				@if(App\Config::getConf('explicit_zones') == 'true')
                    <x-larastrap::radiolist name="area" label="Area" :options="App\Donation::areas()" />
				@endif

                <?php

                $institutes = [];
                foreach(App\Institute::orderBy('name', 'asc')->get() as $institute) {
                    $institutes[$institute->id] = $institute->name;
                }

                $companies = [];
                foreach(App\Company::orderBy('name', 'asc')->get() as $company) {
                    $companies[$company->id] = $company->name;
                }

                ?>

                @if(!empty($institutes))
                    <x-larastrap::checklist-model name="institutes" label="Affiliazioni" :options="$institutes" />
                @endif

                @if(!empty($companies))
                    <x-larastrap::checklist-model name="companies" label="Aziende" :options="$companies" />
                @endif
            </x-larastrap::form>

            @if($user)
                <button class="btn btn-danger" role="button" data-bs-toggle="collapse" href="#destroyUser-{{ $user->id }}">Elimina</button>
                <div class="collapse py-3" id="destroyUser-{{ $user->id }}">
                    <x-larastrap::form method="DELETE" :action="route('utenti.destroy', $user->id)" :buttons="[['element' => 'larastrap::sbtn', 'label' => 'Si, elimina', 'attributes' => ['type' => 'submit']]]" keep_buttons>
                        <div class="alert alert-danger">
                            Sei sicuro di voler eliminare questo utente? Tutte le sue donazioni saranno eliminate.
                        </div>
                    </x-larastrap::form>
                </div>

                @if(!empty($user->verification_code))
                    <x-larastrap::form classes="mt-2" :action="route('giocatori.reverify', $user->id)" :buttons="[['label' => 'Rimanda mail verifica', 'attributes' => ['type' => 'submit']]]" keep_buttons buttons_align="start">
                    </x-larastrap::form>
                @endif
            @endif
        </div>
    </div>
</x-larastrap::modal>
