@extends('layouts.app')

@section('title', 'Contatti')

@section('content')
    <div class="contacts primary-2">
        <div class="row">
            <div class="pagetitle">
                <span>PER INFORMAZIONI</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 right-p">
                <div class="map contact-map" id="mapid"></div>

                <script>
                    var geoJson = {
                        id: "points",
                        type: "symbol",
                        source: {
                            type: "geojson",
                            data: {
                                type: "FeatureCollection",
                                features: [
                                    {
                                        type: 'Feature',
                                        geometry: {
                                            type: "Point",
                                            coordinates: [{{ App\Config::getConf('contact_map_coordinates') }}]
                                        },
                                        properties: {
                                            title: "{{ App\Config::getConf('contact_map_title') }}"
                                        }
                                    }
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
                </script>
            </div>

            <div class="col-md-6 left-p">
                <div class="bordered-spaced">
                    {!! nl2br(App\Config::getConf('contact_main')) !!}
                </div>
                <div>
                    {!! nl2br(App\Config::getConf('contact_contents')) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
