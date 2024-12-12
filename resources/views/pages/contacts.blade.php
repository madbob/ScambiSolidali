@extends('layouts.app')

@section('title', 'Contatti')

@section('content')
    <div class="container contacts primary-2">
        <div class="row">
            <div class="col">
                <div class="pagetitle">
                    <span>{{ t('PER INFORMAZIONI') }}</span>
                </div>
            </div>
        </div>

        {!! App\Config::getConf('contacts_page') !!}

        <div class="row">
            <div class="col">
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
                                            title: "{{ App\Config::getConf('contact_map_title') }}",
                                            description: '',
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

                    var coords = [{{ App\Config::getConf('contact_map_coordinates') }}];
                    var zoom = 15;
                    var bounding = [[{{ App\Config::getConf('contact_map_coordinates') }}], [{{ App\Config::getConf('contact_map_coordinates') }}]];
                </script>
            </div>

            <div class="col">
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
