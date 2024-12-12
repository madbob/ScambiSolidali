<x-larastrap::modal id="sprintf('info-%s', $donation->id)" classes="donation-modal primary-1" size="xl">
    <div class="row">
        <div class="col-12">
            <h4 class="modal-title">{{ $donation->category ? $donation->category->name : '???' }} | {{ $donation->title }}</h4>
            <p class="text-muted"><small><br>{{ url('/celo?show=' . $donation->id) }}</small></p>
        </div>
        <div class="col-md-5">
            <?php $images_number = $donation->imagesNum() ?>
            @for($i = 1; $i <= $images_number; $i++)
                <img src="{{ $donation->imageUrl($i) }}" class="img-fluid">
            @endfor
        </div>
        <div class="offset-md-1 col-md-6">
            <form class="form-horizontal">
                @include('donation.partials.info', ['donation' => $donation])
            </form>
        </div>

        <div class="row">
            <div class="col">
                @include('donation.sameuser', ['donation' => $donation])

                @if($donation->receivers->isEmpty() == false)
                    <hr/>
                    @include('donation.minilist', ['list' => $donation->receivers, 'print_object' => false])
                @endif

                @if($donation->status == 'pending')
                    <hr/>
                    <button class="btn btn-success" role="button" data-bs-toggle="collapse" href="#assignPanel-{{ $donation->id }}">Richiedi l'Oggetto</button>

                    @if($currentuser->role == 'admin' || $currentuser->role == 'operator')
                        <button class="btn btn-danger" role="button" data-bs-toggle="collapse" href="#removePanel-{{ $donation->id }}">Elimina</button>

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
                    @elseif(env('HAS_PUBLIC_OP', false) && $currentuser->role == 'student')
                        <div class="collapse py-3" id="assignPanel-{{ $donation->id }}">
                            @include('donation.assign_self', ['donation' => $donation])
                        </div>
                    @endif
                @elseif($donation->status == 'expiring' || $donation->status == 'expired')
                    <hr/>
                    <form class="form-vertical" method="POST" action="{{ url('celo/arenew/' . $donation->id) }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success" role="button">Rinnova</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-larastrap::modal>
