@extends('layouts.food')

@section('title', 'Giocatori')

@section('content')
    <div class="players primary-6">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="entities">
                <div class="row">
                    <div class="col-md-6">
                        <div class="map" id="mapid"></div>
                        @include('generic.geojson', ['items' => $companies])
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        @foreach($companies as $company)
                            <div class="col-md-12 spaced-middle border-bottom">
                                <p class="institute" data-institute-id="{{ $company->id }}">
                                    @if(!empty($company->website))
                                        <a href="{{ $company->website }}">{{ $company->name }}</a>
                                    @else
                                        {{ $company->name }}
                                    @endif
                                </p>
                            </div>
                        @endforeach

                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
