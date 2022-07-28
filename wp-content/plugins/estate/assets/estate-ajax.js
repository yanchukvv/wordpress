jQuery(function ($) {

    let form = $('#estate-form');
    let buttonSubmit = $('.submit-estate');

    let options = {
        url: estate_ajax.url,
        data: {
            action: 'created_estate',
            nonce: estate_ajax.nonce,
        },
        type: 'POST',
        dataType: 'json',
        beforeSubmit: function (arr, form, options) {

            buttonSubmit.text('Отправка...');
        },
        success: function (response) {

            if (response.data.response === 'ERROR') {
                try {
                    $(form).addClass('was-validated')
                    $.each(response.data.message, function (key, value) {
                        $('#' + key + '_field').append('<div class="invalid-feedback">' + value + '</div>');
                    });
                } catch (e) {
                    add_message(response.data.message, 'danger');
                }

            } else {
                buttonSubmit.text('Добавить объект');
                add_message(response.data.message, 'success');
                form.resetForm();
            }
        },
    };

    form.ajaxForm(options);
});


function add_message($msg, $type) {
    var body = jQuery('body');
    var html = '<div class="alert alert-' + $type + '">' + $msg + '</div>';
    body.find(jQuery('.alert')).remove();
    body.fadeIn('slow').prepend(html);

    setTimeout(function () {
        jQuery('.alert').fadeOut('slow');
    }, 5000);
}