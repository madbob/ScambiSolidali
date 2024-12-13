@extends('layouts.players')

@section('title', t('Giocatori'))

@section('contents')

<div class="row">
    <div class="col-12 col-md-6">
        <div class="map" id="mapid"></div>
        @include('generic.geojson', ['items' => $institutes])
    </div>
    <div class="col-12 col-md-6">
        @foreach($institutes as $institute)
            <div class="spaced-middle border-bottom">
                @if($currentuser && $currentuser->role == 'admin')
                    <div class="float-end">
                        <p class="show-details" data-endpoint="ente" data-item-id="{{ $institute->id }}">Edit</p>
                    </div>
                @endif
                <p class="institute" data-institute-id="{{ $institute->id }}">
                    @if(!empty($institute->website))
                        <a href="{{ $institute->website }}" target="_blank">{{ $institute->name }}</a>
                    @else
                        {{ $institute->name }}
                    @endif
                </p>
            </div>
        @endforeach

        <br/>

        @if($currentuser && $currentuser->role == 'admin')
            <div class="col-12">
                <button class="btn btn-default button" data-bs-toggle="modal" data-bs-target="#institute-new">
                    <span>Aggiungi Associazione</span>
                </button>

                @include('institute.modal', ['institute' => null])
            </div>
        @endif
    </div>
</div>

@endsection
