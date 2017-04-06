@extends('layouts.app')

@section('title', 'Le Mie Donazioni')

@section('content')
    <div class="mydonations primary-5">
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
					@foreach($donations as $donation)
                        <div class="col-md-6 mydonation">
                            <p>{{ date('d.m.Y', strtotime($donation->created_at)) }}</p>
                            <h2>{{ $donation->title }}</h2>
                            <p>
                                <br/>
                                {{ nl2br($donation->description) }}
                            </p>
                        </div>
					@endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
