@extends('layouts.app')

@section('title', 'Le Mie Donazioni')

@section('content')
    <div class="mydonations primary-3">
        <div class="row">
            <div class="pagetitle">
                <span>LE MIE DONAZIONI</span>
            </div>
        </div>

        <div class="row">
            @if($donations->isEmpty())
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <p>
                            Non hai ancora effettuato donazioni.
                        </p>
                    </div>
                </div>
            @else
                <div>
                @foreach($donations as $index => $donation)
                    @if($index % 2 == 0)
                        </div>
                        <div class="col-md-12">
                    @endif

                    <div class="col-md-6 mydonation">
                        <p>{{ date('d.m.Y', strtotime($donation->created_at)) }}</p>
                        <h2>{{ $donation->title }}</h2>
                        <p>
                            <br/>
                            {{ nl2br($donation->description) }}
                        </p>

                        @if($donation->status == 'pending')
                            <p>
                                <a class="button" href="{{ url('donazione/mio/' . $donation->id) }}">
                                    <span>Modifica o Elimina</span>
                                </a>
                            </p>
                        @else
                            <p>
                                <a class="button show-details" data-endpoint="celo" data-item-id="{{ $donation->id }}">
                                    <span>Visualizza</span>
                                </a>
                            </p>
                        @endif
                    </div>
				@endforeach

                </div>
            @endif
        </div>

        @if(!empty($calls))
            <div class="row">
                <div class="pagetitle">
                    <span>I MIEI APPELLI</span>
                </div>
            </div>

            <div class="row">
                @if($calls->isEmpty())
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <p>
                                Non hai ancora effettuato appelli.
                            </p>
                        </div>
                    </div>
                @else
                    <div>
                        @foreach($calls as $index => $call)
                            @if($index % 2 == 0)
                                </div>
                                <div class="col-md-12">
                            @endif

                            <div class="col-md-6 mydonation">
                                <p>{{ date('d.m.Y', strtotime($call->created_at)) }}</p>
                                <h2>{{ $call->title }}</h2>

                                <p>
                                    <a class="button" href="{{ url('manca/?show=' . $call->id) }}">
                                        <span>Modifica</span>
                                    </a>
                                </p>
                            </div>
    					@endforeach
                    </div>
                @endif
            </div>
        @endif

        @if(!empty($assigned))
            <div class="row">
                <div class="pagetitle">
                    <span>DONAZIONI ASSEGNATE</span>
                </div>
            </div>

            <div class="row">
                @if($assigned->isEmpty())
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <p>
                                Non hai ancora effettuato assegnazioni.
                            </p>
                        </div>
                    </div>
                @else
                    <div>
                        @foreach($assigned as $index => $ass)
                            @if($index % 2 == 0)
                                </div>
                                <div class="col-md-12">
                            @endif

                            <div class="col-md-6 mydonation">
                                <p>{{ date('d.m.Y', strtotime($ass->created_at)) }}</p>
                                <h2>{{ $ass->title }}</h2>

                                <p>
                                    <a class="button show-details" data-endpoint="celo" data-item-id="{{ $ass->id }}">
                                        <span>Visualizza</span>
                                    </a>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>

    <div class="primary-5">
        <div class="row">
            <div class="pagetitle">
                <span>IL MIO ACCOUNT</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="#" class="button" data-toggle="modal" data-target="#deleteAccount"><span>Elimina il mio Account</span></a>

                <div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Elimina Account</h4>
                            </div>

                            <form method="POST" action="{{ route('user.delete') }}">
                                @csrf
                                @method('DELETE')

                                <div class="modal-body">
                                    <p>
                                        Eliminando il tuo account elimini anche tutte le donazioni ancora in sospeso.
                                    </p>
                                    <p>
                                        Le tue donazioni già assegnate resteranno comunque accessibili agli operatori (anche se non ci saranno più i tuoi dati personali).
                                    </p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                                    <button type="submit" class="btn btn-danger">Elimina Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
