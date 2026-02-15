@extends('layouts.app')

@section('title', 'Le Mie Donazioni')

@section('content')
    <div class="mydonations primary-3">
        <div class="row">
            <div class="col">
                <div class="pagetitle">
                    <span>LE MIE DONAZIONI</span>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
            @if($donations->isEmpty())
                <div class="col">
                    <div class="alert alert-info">
                        <p>
                            Non hai ancora effettuato donazioni.
                        </p>
                    </div>
                </div>
            @else
                @foreach($donations as $index => $donation)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <p class="d-flex">
                                    <span class="me-2">{{ date('d.m.Y', strtotime($donation->created_at)) }}</span>
                                    {!! $donation->statusBadge() !!}
                                </p>
                                <h2>{{ $donation->title }}</h2>
                                <p>
                                    <br/>
                                    {{ nl2br($donation->description) }}
                                </p>

                                @if($donation->status == 'pending' || $donation->renewable())
                                    <p>
                                        <a class="button" href="{{ url('donazione/mio/' . $donation->id) }}">
                                            <span>Modifica o Elimina</span>
                                        </a>
                                    </p>
                                @else
                                    @if($currentuser->role == 'admin')
                                        <p>
                                            <a class="button show-details" data-endpoint="celo" data-item-id="{{ $donation->id }}">
                                                <span>Visualizza</span>
                                            </a>
                                        </p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
				@endforeach
            @endif
        </div>

        @if(!empty($calls))
            <div class="row">
                <div class="col">
                    <div class="pagetitle">
                        <span>I MIEI APPELLI</span>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
                @if($calls->isEmpty())
                    <div class="col">
                        <div class="alert alert-info">
                            <p>
                                Non hai ancora effettuato appelli.
                            </p>
                        </div>
                    </div>
                @else
                    @foreach($calls as $index => $call)
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <p>{{ date('d.m.Y', strtotime($call->created_at)) }}</p>
                                    <h2>{{ $call->title }}</h2>

                                    <p>
                                        <a class="button" href="{{ url('manca/?show=' . $call->id) }}">
                                            <span>Modifica</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
					@endforeach
                @endif
            </div>
        @endif

        @if(!empty($assigned))
            <div class="row">
                <div class="col">
                    <div class="pagetitle">
                        <span>DONAZIONI ASSEGNATE</span>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
                @if($assigned->isEmpty())
                    <div class="col">
                        <div class="alert alert-info">
                            <p>
                                Non hai ancora effettuato assegnazioni.
                            </p>
                        </div>
                    </div>
                @else
                    @foreach($assigned as $index => $ass)
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <p>{{ date('d.m.Y', strtotime($ass->created_at)) }}</p>
                                    <h2>{{ $ass->title }}</h2>

                                    <p>
                                        <a class="button show-details" data-endpoint="celo" data-item-id="{{ $ass->id }}">
                                            <span>Visualizza</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>

    <div class="primary-5">
        <div class="row">
            <div class="col">
                <a href="#" class="button" data-bs-toggle="modal" data-bs-target="#deleteAccount"><span>Elimina il mio Account</span></a>

                <x-larastrap::modal id="deleteAccount">
                    <x-larastrap::form method="DELETE" route="user.delete" :buttons="[['element' => 'larastrap::sbtn', 'label' => 'Elimina Account', 'attributes' => ['type' => 'submit']]]">
                        <p>
                            Eliminando il tuo account elimini anche tutte le donazioni ancora in sospeso.
                        </p>
                        <p>
                            Le tue donazioni già assegnate resteranno comunque accessibili agli operatori (anche se non ci saranno più i tuoi dati personali).
                        </p>
                    </x-larastrap::form>
                </x-larastrap::modal>
            </div>
        </div>
    </div>
@endsection
