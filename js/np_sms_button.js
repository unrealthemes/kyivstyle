jQuery(document).ready(function($) {
    $('.np_send_sms').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var button = $(this);

        var data = $.extend(
            {
                action: 'send_sms',
            },
            button.data()
        );

        if (button.hasClass('button-disabled')) {
            alert('Смс вже відправлено');
        } else {
            jQuery.post( ajaxurl, data, function(response) {
                if (response === 'success') {
                    alert('Смс успішно відправлено');
                    button.addClass('button-disabled');
                } else {
                    alert('Виникла помилка: ' + response);
                }
            });
        }
    });
});