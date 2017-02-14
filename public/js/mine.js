$(document).ready(function() {
    function dynamicModal(endpoint, id) {
        $.ajax('/' + endpoint + '/' + id, {
            method: 'GET',
            dataType: 'HTML',
            success: function(data) {
                var d = $(data);
                $('body').append(d);
                d.modal('show');
                $('.chosen-select', d).chosen({width: "100%"});
            }
        });
    }

    if ($('#mapid').length > 0) {
        var markers = new Array();

        $('#mapid').css('height', $(window).height() - 250);

        mapboxgl.accessToken = 'pk.eyJ1IjoibWFkYm9iIiwiYSI6ImNpdzE5MHN2ajAwMXYydG8xejBvbHdzOWwifQ.Lk5hnbjb720Z4C_jfqzBNg';
        var map = new mapboxgl.Map({
            container: 'mapid',
            style: 'mapbox://styles/mapbox/streets-v9',
            center: [7.6700, 45.0516],
            zoom: 12
        });

        /*
            L'oggetto geoJson viene generato all'interno del template
        */

        map.on('load', function() {
            map.addSource("places", {
                "type": "geojson",
                "data": geoJson
            });

            geoJson.features.forEach(function(feature) {
                var symbol = feature.properties['category'];
                var layerID = 'poi-' + symbol;

                if (!map.getLayer(layerID)) {
                    var layer = map.addLayer({
                        "id": layerID,
                        "type": "symbol",
                        "source": "places",
                        "layout": {
                            "icon-image": "star-15",
                            "icon-allow-overlap": true
                        },
                        "filter": ["==", "category", symbol]
                    });

                    $('input[type=checkbox][name=category_id][value=' + symbol + ']').change(function() {
                        map.setLayoutProperty(layerID, 'visibility', $(this).prop('checked') ? 'visible' : 'none');
                    });
                }
            });
        });

        map.on('click', function (e) {
            var features = map.queryRenderedFeatures(e.point);
            if (!features.length)
                return;

            var feature = features[0];
            dynamicModal('donazione', feature.properties['id']);
        });
    }

    if ($('#map-select').length > 0) {
        mapboxgl.accessToken = 'pk.eyJ1IjoibWFkYm9iIiwiYSI6ImNpdzE5MHN2ajAwMXYydG8xejBvbHdzOWwifQ.Lk5hnbjb720Z4C_jfqzBNg';
        var map = new mapboxgl.Map({
            container: 'map-select',
            style: 'mapbox://styles/mapbox/streets-v9',
            center: [7.6700, 45.0516],
            zoom: 12
        });

        var geocoder = new MapboxGeocoder({
            proximity: {latitude: 45.0516, longitude: 7.6700},
            bbox: [7.430458,44.907397,7.900369,45.194847],
            placeholder: 'Scrivi qui l\'indirizzo',
            accessToken: mapboxgl.accessToken
        });
        map.addControl(geocoder);

        /*
            Questo è per forzare l'attributo "required" nel campo di testo dove
            mettere l'indirizzo
        */
        $('.mapboxgl-ctrl-geocoder input:text').attr('required', 'required');

        geocoder.on('result', function(ev) {
            $('input[name=address]').val(ev.result.place_name);
            $('input[name=coordinates]').val(ev.result.geometry.coordinates[1] + ',' + ev.result.geometry.coordinates[0]);
        });
    }

    $('.chosen-select').chosen({width: "100%"});

    $('.new-donation-form form input').keydown(function(event) {
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $('.show-details').click(function(e) {
        e.preventDefault();
        var endpoint = $(this).attr('data-endpoint');
        var id = $(this).attr('data-item-id');
        dynamicModal(endpoint, id);
    });
});
