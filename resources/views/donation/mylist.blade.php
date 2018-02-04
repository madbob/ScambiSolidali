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
            <div class="col-md-12">
                @if($donations->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non hai ancora effettuato donazioni.
                        </p>
                    </div>
                @else
					@foreach($donations as $index => $donation)
                        @if($index % 2 == 0 && $index != 0)
                            <div class="clearfix"></div>
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
                                        <span>Modifica</span>
                                    </a>
                                </p>
                            @endif
                        </div>
					@endforeach
                @endif
            </div>
        </div>

        @if(!empty($calls))
            <div class="row">
                <div class="pagetitle">
                    <span>I MIEI APPELLI</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
					@foreach($calls as $index => $call)
                        @if($index % 2 == 0 && $index != 0)
                            <div class="clearfix"></div>
                        @endif

                        <div class="col-md-6 mydonation">
                            <p>{{ date('d.m.Y', strtotime($call->created_at)) }}</p>
                            <h2>{{ $call->title }}</h2>

                            @if($call->status == 'open')
                                <p>
                                    <a class="button" href="{{ url('manca/?show=' . $call->id) }}">
                                        <span>Modifica</span>
                                    </a>
                                </p>
                            @endif
                        </div>
					@endforeach
                </div>
            </div>
        @endif

        @if(!empty($assigned))
            <div class="row">
                <div class="pagetitle">
                    <span>DONAZIONI ASSEGNATE</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @foreach($assigned as $index => $ass)
                        @if($index % 2 == 0 && $index != 0)
                            <div class="clearfix"></div>
                        @endif

                        <div class="col-md-6 mydonation">
                            <p>{{ date('d.m.Y', strtotime($ass->created_at)) }}</p>
                            <h2>{{ $ass->title }}</h2>

                            @if($call->status == 'open')
                                <p>
                                    <a class="button" href="{{ url('celo/?show=' . $ass->id) }}">
                                        <span>Modifica</span>
                                    </a>
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
