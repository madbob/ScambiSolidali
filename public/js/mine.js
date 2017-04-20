$(document).ready(function() {
    function commonInit() {
        $('.chosen-select').chosen({width: "100%"});

        $('.map-select').each(function() {
            mapboxgl.accessToken = 'pk.eyJ1IjoibWFkYm9iIiwiYSI6ImNpdzE5MHN2ajAwMXYydG8xejBvbHdzOWwifQ.Lk5hnbjb720Z4C_jfqzBNg';
            var map = new mapboxgl.Map({
                container: $(this).attr('id'),
                style: 'mapbox://styles/mapbox/light-v9',
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
            var form = $(this).closest('form');

            geocoder.on('result', function(ev) {
                $('input[name=address]', form).val(ev.result.place_name);
                $('input[name=coordinates]', form).val(ev.result.geometry.coordinates[1] + ',' + ev.result.geometry.coordinates[0]);
            });
        });
    }

    function dynamicModal(endpoint, id) {
        if (endpoint.indexOf('{id}') != -1)
            endpoint = '/' + endpoint.replace('{id}', id);
        else
            endpoint = '/' + endpoint + '/' + id;

        $.ajax(endpoint, {
            method: 'GET',
            dataType: 'HTML',
            success: function(data) {
                var d = $(data);
                $('body').append(d);
                d.modal('show');
                d.on('hidden.bs.modal', function() {
                    $(this).remove();
                });
                commonInit();
            }
        });
    }

    $('input.date').datepicker({
        format: 'DD dd MM yyyy',
        autoclose: true,
        language: 'it',
        clearBtn: true
    });

    $('.chosen-select').chosen({width: "100%"});

    $('body').on('change', '.single-saving-notice-toggle', function() {
        var endpoint = $(this).attr('data-endpoint');
        var status = $(this).prop('checked');
        var notice = $(this).parent().find('.single-saving-notice');
        notice.empty().show().append('<span class="glyphicon glyphicon-time" aria-hidden="true"></span>');

        $.ajax(endpoint, {
            method: 'POST',
            data: {
                status: status,
                _token: window.Laravel.csrfToken
            },
            success: function(data) {
                notice.empty().append('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>').fadeOut(2000);
            }
        });

    }).on('click', '.fileuploader', function(e) {
        $(this).find('input:file').click();

    }).on('click', '.fileuploader input:file', function(e) {
        e.stopPropagation();

    }).on('change', '.fileuploader input:file', function() {
        var input = this;

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = new Image();
                img.onload = function() {
                    var ratio = 200 / img.width;
                    var canvas = $("<canvas>")[0];
                    canvas.width = img.width * ratio;
                    canvas.height = img.height * ratio;
                    var ctx = canvas.getContext("2d");
                    ctx.drawImage(img, 0,0,canvas.width, canvas.height);

                    var cell = $(input).closest('.fileuploader');
                    if (cell.attr('data-inited') == null) {
                        var ncell = cell.clone();
                        ncell.find('input').val('').removeAttr('required');
                        cell.after(ncell);
                    }
                    cell.attr('data-inited', true);

                    cell.find('.image-frame').empty().css('background-image', 'url(' + canvas.toDataURL() + ')');
                }

                img.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }

    }).on('click', '.removefile', function() {
        $(this).closest('.common-card').remove();
    });

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

    if ($('input:hidden[name=trigger-show-details]').length != 0) {
        $('input:hidden[name=trigger-show-details]').each(function() {
            var endpoint = $(this).attr('data-endpoint');
            var id = $(this).attr('data-item-id');
            if (id != -1)
                dynamicModal(endpoint, id);
        });
    }

    if ($('#mapid').length > 0) {
        var markers = new Array();

        $('#mapid').css('height', $(window).height() - 300);

        var coords = [7.6700, 45.0516];
        var zoom = 12;

        if ($('#mapid').hasClass('contact-map')) {
            coords = [7.67824, 45.05408];
            zoom = 15;
        }

        mapboxgl.accessToken = 'pk.eyJ1IjoibWFkYm9iIiwiYSI6ImNpdzE5MHN2ajAwMXYydG8xejBvbHdzOWwifQ.Lk5hnbjb720Z4C_jfqzBNg';
        var map = new mapboxgl.Map({
            container: 'mapid',
            style: 'mapbox://styles/mapbox/light-v9',
            center: coords,
            zoom: zoom
        });

        /*
            L'oggetto geoJson viene generato all'interno del template
        */

        map.on('load', function() {
            map.addLayer(geoJson);
        });

        map.on('click', function (e) {
            var features = map.queryRenderedFeatures(e.point);
            if (!features.length)
                return;

            var feature = features[0];
            $('.institute').removeClass('selected').filter('[data-institute-id=' + feature.properties['id'] + ']').addClass('selected');
        });
    }

    commonInit();
});
