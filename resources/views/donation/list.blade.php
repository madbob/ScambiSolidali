@extends('layouts.app')

@section('title', 'Celo')

@section('content')
    <input type="hidden" name="trigger-show-details" data-endpoint="celo" data-item-id="{{ $current_show }}">

    <div class="celo primary-1">
    	<div class="row">
    		<div class="col-md-2">
                <button data-toggle="modal" data-target="#celo-select" class="dense-button">
                    <span>Celo!</span>
                </button>

                <br/>

                <p>
                    Qui puoi inserire il tuo annuncio!<br/>
                    Dicci cosa vuoi regalare e attendi la nostra risposta!
                </p>

                @if($user && $user->role == 'admin')
                    <a href="{{ url('/celo/archivio') }}" class="btn btn-default">
                        <span>Vedi Archivio Completo</span>
                    </a>
                @endif

                @include('category.filter', ['filter' => $filter, 'endpoint' => 'celo'])
            </div>

            <div class="col-md-9 col-md-offset-1">
                @if($donations->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non ci sono oggetti.
                        </p>
                    </div>
                @else
    				@foreach($donations as $donation)
                        <div class="col-md-4 right-p">
                            <div class="common-card">
                                <div class="card-main image-frame" style="background-image: url('{{ $donation->imageUrl(1) }}')">
                                    &nbsp;
                                </div>
                                @if($donation->status == 'assigned')
                                    <div class="card-main-filter">
                                    </div>
                                    <div class="card-main-overlay">
                                        <span>
                                            <p>Consegnato!</p>
                                            <img src="{{ url('images/trofeo.svg') }}">
                                        </span>
                                    </div>
                                @endif
                                <div class="card-footer vert-align">
                                    <p>
                                        @if($edit_enabled)
                                            <a class="show-details" data-endpoint="celo" data-item-id="{{ $donation->id }}">{{ $donation->title }}</a>
                                        @else
                                            {{ $donation->title }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
    				@endforeach

                    <p class="clearfix">&nbsp;</p>
        			{{ $donations->links() }}
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
                            <div class="col-md-5">
                                <a href="{{ url('celo/nuovo/oggetto') }}">
                                    <div class="common-card">
                                        <div class="card-main image-frame empty" style="background-image: url('{{ url('images/oggetti-filled.svg') }}')">
                                            &nbsp;
                                        </div>
                                        <div class="card-footer vert-align">
                                            <p>
                                                Dona un oggetto
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-5 col-md-offset-2">
                                <a href="{{ url('celo/nuovo/servizio') }}">
                                    <div class="common-card">
                                        <div class="card-main image-frame" style="background-image: url('{{ url('images/tempo.svg') }}')">
                                            &nbsp;
                                        </div>
                                        <div class="card-footer vert-align filled">
                                            <p>
                                                Dona una competenza
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
