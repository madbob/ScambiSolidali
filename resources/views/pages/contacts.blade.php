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
                                            coordinates: [7.67824, 45.05408]
                                        },
                                        properties: {
                                            title: "Casa del Quartiere"
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
                    Ass. Agenzia per lo sviluppo di San Salvario onlus<br/>c/o Casa del Quartiere San Salvario
                </div>
                <div>
                    via Morgari 14 - 10125 Torino<br/>
                    segreteria@agenzia.sansalvario.org<br/>
                    T 011 6686772
                </div>
            </div>
        </div>
    </div>
@endsection
