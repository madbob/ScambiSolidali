$(document).ready(function() {
    function commonInit() {
        $('.map-select').each(function() {
            mapboxgl.accessToken = 'pk.eyJ1IjoibWFkYm9iIiwiYSI6ImNpdzE5MHN2ajAwMXYydG8xejBvbHdzOWwifQ.Lk5hnbjb720Z4C_jfqzBNg';
            var map = new mapboxgl.Map({
                container: $(this).attr('id'),
                style: 'mapbox://styles/mapbox/light-v9',
                center: coords,
                zoom: 12
            });

            var geocoder = new MapboxGeocoder({
                proximity: {latitude: coords[1], longitude: coords[0]},
                bbox: [coords[0] - 0.5, coords[1] - 0.5, coords[0] + 0.5, coords[1] + 0.5],
                placeholder: 'Scrivi qui l\'indirizzo',
                accessToken: mapboxgl.accessToken
            });
            map.addControl(geocoder);

            var form = $(this).closest('form');
            $('.mapboxgl-ctrl-geocoder input:text').prop('required', true);
            $('.mapboxgl-ctrl-geocoder input:text').val(form.find('input[name=address]').val());

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

    function previewImage(input, img, angle) {
        var ratio = 400 / img.width;
        var canvas = $("<canvas>")[0];
        canvas.width = img.width * ratio;
        canvas.height = img.height * ratio;
        var ctx = canvas.getContext("2d");

        ctx.save();

        if (angle != 0) {
            ctx.translate(canvas.width / 2, canvas.height / 2);
            ctx.rotate(angle * Math.PI / 180);
            ctx.drawImage(img, -canvas.width/2, -canvas.height/2, canvas.width, canvas.height);
        }
        else {
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        }

        ctx.restore();

        var cell = $(input).closest('.fileuploader');
        if (cell.attr('data-inited') == null) {
            var ncell = cell.clone();
            ncell.find('input').val('').removeAttr('required');
            cell.after(ncell);
        }
        cell.attr('data-inited', true);

        cell.find('.image-frame').empty().css('background-image', 'url(' + canvas.toDataURL() + ')');
    }

    $('input.date').datepicker({
        format: 'DD dd MM yyyy',
        autoclose: true,
        language: 'it',
        clearBtn: true
    });

    $('.register-form form').submit(function(e) {
        var checkbox = $(this).find('input[name=privacy]')
        var check = checkbox.prop('checked');
        if (check == false) {
            checkbox.closest('.checkbox').addClass('has-error');
            e.stopPropagation();
            e.preventDefault();
            return false;
        }
        else {
            checkbox.closest('.checkbox').removeClass('has-error');
            return true;
        }
    });

    $('body').on('click', '.async-delete-interaction', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-item-id');
        var donation = $(this).attr('data-donation-id');
        var url = '';

        if ($(this).hasClass('booking'))
            url = '/donazione/detach/booking/' + donation + '/' + id;
        else
            url = '/donazione/detach/assignation/' + donation + '/' + id;

        var row = $(this).closest('tr').first();

        $.ajax(url, {
            method: 'POST',
            data: {
                _token: window.Laravel.csrfToken
            },
            success: function(data) {
                row.remove();
            }
        });
    });

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
                    var convertExifOrienationToAngle = function (orientation) {
                        var exifDegrees = [
                            0, // 0 - not used
                            0, // 1 - The 0th row is at the visual top of the image, and the 0th column is the visual left-hand side.
                            0, // 2 - The 0th row is at the visual top of the image, and the 0th column is the visual right-hand side.
                            180, // 3 - The 0th row is at the visual bottom of the image, and the 0th column is the visual right-hand side.
                            0, // 4 - The 0th row is at the visual bottom of the image, and the 0th column is the visual left-hand side.
                            0, // 5 - The 0th row is the visual left-hand side of the image, and the 0th column is the visual top.
                            90, // 6 - The 0th row is the visual right-hand side of the image, and the 0th column is the visual top.
                            0, // 7 - The 0th row is the visual right-hand side of the image, and the 0th column is the visual bottom.
                            270 // 8 - The 0th row is the visual left-hand side of the image, and the 0th column is the visual bottom.
                        ];
                        if (orientation > 0 && orientation < 9 && exifDegrees[orientation] != 0)
                            return exifDegrees[orientation];
                        else
                            return 0;
                    };

                    var test = EXIF.getData(img, function() {
                        var angle = convertExifOrienationToAngle(EXIF.getTag(img, "Orientation") || 0);
                        previewImage(input, img, angle);
                    });

                    if (test == false) {
                        previewImage(input, img, 0);
                    }
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

    $('.new-donation-form').submit(function(e) {
        e.preventDefault();

        if ($(this).find('input:hidden[name^=keep_photo]').length == 0) {
            var photo_set = false;
            var photo_slots = $(this).find('input:file[name^=photo]');
            if (photo_slots.length > 0) {
                $(this).find('input:file[name^=photo]').each(function() {
                    photo_set = photo_set || $(this).val() != '';
                });
            }
            else {
                photo_set = true;
            }
        }
        else {
            photo_set = true;
        }

        if (photo_set == false)
            alert('Devi caricare almeno una foto!');
        else
            $(this).unbind('submit').submit();
    });

    $('input[name=role-filter]').change(function() {
        if ($(this).prop('checked')) {
            var role = $(this).attr('data-role');
            if (role == 'all') {
                $('.users-list tr').show();
            }
            else {
                $('.users-list tr').hide();
                $('.users-list tr[data-role=' + role + ']').show();
            }
        }
    });

    $('.journal .btn').click(function(e) {
        e.preventDefault();
    });

    $('body').on('click', '.show-details', function(e) {
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

        /*
            I parametri "coords" e "zoom" sono inizializzati nel DOM della
            pagina, essendo letti dalle configurazioni sul DB
        */

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

    $('.checklist-filling-row.boolean-select').on('change', 'input:radio', function() {
        var row = $(this).closest('li');
        var button = $(this).closest('.btn');

        var selected = $(this).val();
        if (selected == 'true') {
            row.removeClass('list-group-item-danger').addClass('list-group-item-success');
            button.removeClass('btn-light').addClass('btn-success');
            button.siblings('.btn').removeClass('btn-danger').addClass('btn-light');
        }
        else {
            row.removeClass('list-group-item-success').addClass('list-group-item-danger');
            button.removeClass('btn-light').addClass('btn-danger');
            button.siblings('.btn').removeClass('btn-success').addClass('btn-light');
        }
    });

    $('.checklist-filling-row.quantity-select').on('change', 'input:radio', function() {
        $(this).closest('li').removeClass('list-group-item-danger').addClass('list-group-item-success');

        var button = $(this).closest('.btn');
        button.removeClass('btn-light').addClass('btn-success');
        button.siblings('.btn').removeClass('btn-success').addClass('btn-light');
    });

    commonInit();
});
