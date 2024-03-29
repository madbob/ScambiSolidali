@extends('layouts.app')

@section('title', 'Celo')

@section('content')
    <input type="hidden" name="trigger-show-details" data-endpoint="celo" data-item-id="{{ $current_show }}">

    <div class="celo primary-1">
    	<div class="row">
    		<div class="col-md-3 col-lg-2">
                <button data-toggle="modal" data-target="#celo-select" class="dense-button">
                    <span>{{ t('Celo!') }}</span>
                </button>

                <br/>

                <p>
                    <a href="#" class="black" data-toggle="modal" data-target="#celo-select">
                        {!! t('Qui puoi inserire il tuo annuncio!<br/>Dicci cosa vuoi regalare e attendi la nostra risposta!') !!}
                    </a>
                </p>

                @if($user && $user->role == 'admin')
                    <a href="{{ url('/celo/archivio') }}" class="btn btn-default">
                        <span>Vedi Archivio Completo</span>
                    </a>

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

            <div class="col-md-8 col-md-offset-1 col-lg-9 col-lg-offset-1">
                @if($donations->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non ci sono oggetti.
                        </p>
                    </div>
                @else
    				@foreach($donations as $donation)
                        <div class="col-md-6 col-lg-4 right-p">
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
                                            <img src="{{ url('images/trofeo.svg') }}">
                                        </span>
                                    </div>
                                @endif
                                <div class="card-footer vert-align">
                                    <p>
                                        @if($edit_enabled || $donation->userCanView($currentuser))
                                            <a href="#" class="show-details" data-endpoint="celo" data-item-id="{{ $donation->id }}">{{ $donation->title }}</a>
                                        @else
                                            <a href="#" data-toggle="modal" data-target="#require-registration">{{ $donation->title }}</a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
    				@endforeach

                    <p class="clearfix">&nbsp;</p>

                    <div class="text-center">
                        {{ $donations->links() }}
                    </div>
                @endif
    		</div>
    	</div>

        <div class="modal fade" id="celo-select" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-6 col-md-5">
                                <a href="{{ url('celo/nuovo/oggetto') }}">
                                    <div class="common-card visible-md visible-lg">
                                        <div class="card-main image-frame" style="background-image: url('{{ url('images/oggetti.svg') }}')">
                                            &nbsp;
                                        </div>
                                        <div class="card-footer vert-align filled">
                                            <p>
                                                Dona un oggetto
                                            </p>
                                        </div>
                                    </div>

                                    <p class="visible-xs visible-sm btn btn-default btn-flow">
                                        Clicca qui per donare un oggetto
                                    </p>
                                </a>
                            </div>

                            <div class="col-xs-6 col-md-5 col-md-offset-2">
                                <a href="{{ url('celo/nuovo/servizio') }}">
                                    <div class="common-card visible-md visible-lg">
                                        <div class="card-main image-frame" style="background-image: url('{{ url('images/tempo.svg') }}')">
                                            &nbsp;
                                        </div>
                                        <div class="card-footer vert-align filled">
                                            <p>
                                                Dona una competenza
                                            </p>
                                        </div>
                                    </div>

                                    <p class="visible-xs visible-sm btn btn-default btn-flow">
                                        Clicca qui per donare una competenza
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="require-registration" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
