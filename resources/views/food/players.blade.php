@extends('layouts.food')

@section('title', 'Giocatori')

@section('content')
    <div class="players primary-6">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="entities">
                <div class="row">
                    <div class="col-md-6">
                        <div class="map" id="mapid"></div>

                        <script>
                            var geoJson = {
                                id: "points",
                                type: "symbol",
                                source: {
                                    type: "geojson",
                                    data: {
                                        type: "FeatureCollection",
                                        features: [
                                            @foreach($companies as $company)
                                                {
                                                    type: 'Feature',
                                                    geometry: {
                                                        type: "Point",
                                                        coordinates: [{{ $company->lng }}, {{ $company->lat }}]
                                                    },
                                                    properties: {
                                                        title: "",
                                                        id: {{ $company->id }}
                                                    }
                                                },
                                            @endforeach
                                        ]
                                    }
                                },
                                layout: {
                                    "icon-image": "star-15",
                                    "icon-allow-overlap": true,
                                    "text-field": "{title}",
                                    "text-font": ["Open Sans Semibold", "Arial Unicode MS Bold"],
                                    "text-offset": [0, 0.6],
                                    "text-anchor": "top"
                                }
                            };

                            var coords = [{{ App\Config::getConf('players_map_coordinates') }}];
                            var zoom = {{ App\Config::getConf('players_map_zoom') }};
                        </script>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        @foreach($companies as $company)
                            <div class="col-md-12 spaced-middle border-bottom">
                                <p class="institute" data-institute-id="{{ $company->id }}">
                                    {{ $company->name }}
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
