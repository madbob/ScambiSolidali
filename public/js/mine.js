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

    function manyRowsAddDeleteButtons(node) {
        if (node.find('.delete-many-rows').length == 0) {
            var fields = node.find('.single-row');
            if (fields.length > 1) {
                fields.each(function() {
                    var button = '<button class="btn btn-danger delete-many-rows"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
                    $(this).append(button);
                });
            }
        }
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

    }).on('click', '.many-rows .delete-many-rows', function(e) {
        e.preventDefault();
        var container = $(this).closest('.many-rows');
        $(this).closest('.single-row').remove();
        if (container.find('.single-row').length <= 1)
            container.find('.delete-many-rows').remove();
        return false;

    }).on('click', '.many-rows .add-many-rows', function(e) {
        e.preventDefault();
        var container = $(this).parents('.many-rows');
        var row = container.find('.single-row').first().clone();
        row.find('input').val('');
        row.find('img').attr('src', '#').hide();
        row.find('select option').removeAttr('selected');
        container.find('.add-many-rows').closest('div').before(row);
        manyRowsAddDeleteButtons(container);
        return false;

    }).on('change', '.filestyle', function() {
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
                    $(input).siblings('img').show().attr('src', canvas.toDataURL());
                }

                img.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    });

    $('.many-rows img').hide();

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
});
