$(document).ready(function() {
    function commonInit() {
        $('.chosen-select').chosen({width: "100%"});
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
                        cell.after(ncell);
                    }
                    cell.attr('data-inited', true);

                    cell.find('.image-frame').empty().css('background-image', 'url(' + canvas.toDataURL() + ')');
                }

                img.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
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
            dynamicModal(endpoint, id);
        });
    }

    commonInit();
});
