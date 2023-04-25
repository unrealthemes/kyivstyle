$(document).ready(function () {
    if ($('#recipient_phone').length == 1) {
        var recipientPhone  = $('#recipient_phone');
        var newRecipientPhone = recipientPhone.val().replace(/[^0-9\.]/g, '');
        recipientPhone.val(newRecipientPhone);
    }
    $('#recipient_phone').on('keypress', function (e) {
        if (e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });
});