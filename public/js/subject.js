
// Subject Remove
$(document).on('click', '.btn_subject', function () {
    $.ajax({
        url: BASE + '/subjects/delete',
        method: "POST",
        async: true,
        dataType: "json",
        data: {
            'id': this.id,
            '_token' : $('meta[name="csrf-token"]').attr('content')
        },
        cache: false
    }).done(function (resp) {
        if (resp['common_msg'] !== undefined) {
            swal(resp['common_msg'].title, resp['common_msg'].message, resp['common_msg'].type).then(function () {
                location.reload();
                return false;
            });
        }
    });
});

