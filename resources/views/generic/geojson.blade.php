<script>
    <?php
    $min_lng = $min_lat = 90;
    $max_lng = $max_lat = 0;
    ?>

    var geoJson = {
        id: "points",
        type: "symbol",
        source: {
            type: "geojson",
            data: {
                type: "FeatureCollection",
                features: [
                    @foreach($items as $item)
                        {
                            type: 'Feature',
                            geometry: {
                                type: "Point",
                                coordinates: [{{ $item->lng }}, {{ $item->lat }}]

                                <?php
                                $min_lng = min($min_lng, $item->lng);
                                $min_lat = min($min_lat, $item->lat);
                                $max_lng = max($max_lng, $item->lng);
                                $max_lat = max($max_lat, $item->lat);
                                ?>
                            },
                            properties: {
                                title: "{{ $item->name }}",
                                id: {{ $item->id }}
                            }
                        },
                    @endforeach
                ]
            }
        }
    };

    var coords = [{{ App\Config::getConf('players_map_coordinates') }}];
    var zoom = {{ App\Config::getConf('players_map_zoom') }};
    var bounding = [[{{ $min_lng }}, {{ $min_lat }}], [{{ $max_lng }}, {{ $max_lat }}]];
</script>
