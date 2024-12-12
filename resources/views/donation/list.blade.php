@extends('layouts.app')

@section('title', 'Celo')

@section('content')
    <input type="hidden" name="trigger-show-details" data-endpoint="celo" data-item-id="{{ $current_show }}">

    <div class="celo primary-1">
    	<div class="row">
            <div class="col-12 col-md-3">
                <button data-bs-toggle="modal" data-bs-target="#celo-select" class="dense-button">
                    <span>{{ t('Celo!') }}</span>
                </button>

                <br/>

                <p>
                    <a href="#" class="black" data-bs-toggle="modal" data-bs-target="#celo-select">
                        {!! t('Qui puoi inserire il tuo annuncio!<br/>Dicci cosa vuoi regalare e attendi la nostra risposta!') !!}
                    </a>
                </p>

                @if($user && $user->role == 'admin')
                    <a href="{{ route('celo.archive') }}" class="btn btn-light">Vedi Archivio Completo</a>

                    @if(env('HAS_FOOD', false))
                        <a href="{{ url('/periodico') }}" class="btn btn-default">
                            <span>Donazioni Periodiche</span>
                        </a>
                    @endif
                @endif

                @include('category.filter', ['filter' => $filter, 'direct_response' => false, 'endpoint' => 'celo'])

                @if(App\Config::getConf('explicit_zones') == 'true')
                    @include('donation.areafilter', ['areafilter' => $areafilter, 'endpoint' => 'celo'])
                @endif
            </div>

            <div class="col-12 col-md-9">
                @if($donations->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non ci sono oggetti.
                        </p>
                    </div>
                @else
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 m-0">
        				@foreach($donations as $donation)
                            <div class="col p-1">
                                <div class="common-card">
                                    <div class="card-main image-frame" style="background-image: url('{{ $donation->imageUrl(1) }}')">
                                        &nbsp;
                                    </div>
                                    @if($donation->status == 'assigned')
                                        <div class="card-main-filter">
                                        </div>
                                        <div class="card-main-overlay">
                                            <span>
                                                <p>Assegnato!</p>
                                                <img src="{{ Vite::asset('resources/images/trofeo.svg') }}">
                                            </span>
                                        </div>
                                    @endif
                                    <div class="card-footer vert-align">
                                        <p>
                                            @if($edit_enabled || $donation->userCanView($currentuser))
                                                <a href="#" class="show-details" data-endpoint="celo" data-item-id="{{ $donation->id }}">{{ $donation->title }}</a>
                                            @else
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#require-registration">{{ $donation->title }}</a>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
        				@endforeach
                    </div>

                    <div class="text-center">
                        {{ $donations->links() }}
                    </div>
                @endif
    		</div>
    	</div>

        <x-larastrap::modal id="celo-select" size="lg">
            <div class="row justify-content-around g-5">
                <div class="col">
                    <a href="{{ route('celo.create', ['type' => 'oggetto']) }}">
                        <div class="common-card d-none d-md-block">
                            <div class="card-main image-frame" style="background-image: url('{{ Vite::asset('resources/images/oggetti.svg') }}')">
                                &nbsp;
                            </div>
                            <div class="card-footer vert-align filled">
                                <p>
                                    Dona un oggetto
                                </p>
                            </div>
                        </div>

                        <p class="d-block d-md-none btn btn-light btn-flow">
                            Clicca qui per donare un oggetto
                        </p>
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('celo.create', ['type' => 'servizio']) }}">
                        <div class="common-card d-none d-md-block">
                            <div class="card-main image-frame" style="background-image: url('{{ Vite::asset('resources/images/tempo.svg') }}')">
                                &nbsp;
                            </div>
                            <div class="card-footer vert-align filled">
                                <p>
                                    Dona una competenza
                                </p>
                            </div>
                        </div>

                        <p class="d-block d-md-none btn btn-light btn-flow">
                            Clicca qui per donare una competenza
                        </p>
                    </a>
                </div>
            </div>
        </x-larastrap::modal>

        <x-larastrap::modal id="require-registration">
            <p>
                Per accedere ai dettagli degli oggetti donati devi essere un utente registrato e accreditato dagli amministratori.
            </p>

            @if(env('HAS_PUBLIC_OP', false))
                <p>
                    <a href="{{ route('register') }}">Clicca qui per registrarti e chiedere l'abilitazione.</a>
                </p>
            @else
                <p>
                    <a href="{{ route('contacts') }}">Contattaci per maggiori informazioni.</a>
                </p>
            @endif
        </x-larastrap::modal>
    </div>
@endsection
