<x-larastrap::modal :id="sprintf('info-%s', $donation->id)" size="xl" classes="primary-1">
    <div class="row">
        <div class="col-12">
            <h4 class="modal-title" id="myModalLabel">{{ $donation->category->name }} | {{ $donation->title }}</h4>
            <p class="text-muted"><small><br>{{ url('/celo?show=' . $donation->id) }}</small></p>
        </div>
        <div class="col-12">
            <form class="form-horizontal">
                @include('donation.partials.info', ['donation' => $donation])
            </form>
        </div>

        @if($currentuser->role == 'admin' || $currentuser->role == 'operator')
            <div class="row">
                <div class="col">
                    @include('donation.sameuser', ['donation' => $donation])

                    @if($donation->receivers->isEmpty() == false)
                        <hr/>
                        @include('donation.minilist', ['list' => $donation->receivers, 'print_object' => false])
                    @endif

                    @if($donation->status == 'pending')
                        <hr/>
                        <button class="btn btn-success" role="button" data-toggle="collapse" href="#assignPanel-{{ $donation->id }}" aria-expanded="false" aria-controls="assignPanel-{{ $donation->id }}">Servizio Assegnato</button>
                        <button class="btn btn-danger" role="button" data-toggle="collapse" href="#removePanel-{{ $donation->id }}" aria-expanded="false" aria-controls="removePanel-{{ $donation->id }}">Elimina</button>
                    @endif

                    <div class="collapse py-3" id="assignPanel-{{ $donation->id }}">
                        <div class="alert alert-info">
                            Indica qui alcuni dati relativi al beneficiario della donazione, a seconda che sia una persona o un ente.
                        </div>

                        <x-larastrap::tabs active="0">
                            <x-larastrap::tabpane label="Persona">
                                @include('donation.assign_user', ['donation' => $donation])
                            </x-larastrap::tabpane>
                            <x-larastrap::tabpane label="Ente">
                                @include('donation.assign_org', ['donation' => $donation])
                            </x-larastrap::tabpane>
                        </x-larastrap::tabs>
                    </div>

                    <div class="collapse py-3" id="removePanel-{{ $donation->id }}">
                        @include('donation.partials.remove')
                    </div>
                </div>
            </div>
        @elseif(env('HAS_PUBLIC_OP', false) && $currentuser->role == 'student')
            <div class="row">
                <div class="col">
                    <hr>

                    <div class="alert alert-info">
                        Da qui puoi metterti in contatto con chi offre questo servizio: scrivi la tua richiesta ed inviala da qui. Il donatore riceverà il tuo nome ed il tuo indirizzo email per mettersi nuovamente in contatto con te.
                    </div>

                    <x-larastrap::form :action="route('donation.contact', $donation->id)" :buttons="['label' => 'Invia Richiesta!', 'attributes' => ['type' => 'submit']]">
                        <x-larastrap::textarea name="request" label="La tua Richiesta" required />
                    </x-larastrap::form>
                </div>
            </div>
        @endif
    </div>
</x-larastrap::modal>
