$("#add").click(function () {
    $.ajax({
        type: 'post',
        url: '/addItem',
        data: {
            '_token': $('input[name=_token]').val(),
            'descricao': $('input[name=descricao]').val()
        },
        success: function (data) {
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                $('.error').text(data.errors.name);
            } else {
                $('.error').remove();
                $('#table').append("<tr class='item" + data.id + "'>" +
                    "<td>" + data.id + "</td" +
                    "><td>" + data.descricao + "</td>" +
                    "<td>" +
                    "<button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.descricao + "'>" +
                    "<span class='pe-7s-note'>" +
                    "</span> Edit</button>" +
                    "<button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.descricao + "'>" +
                    "<span class='pe-7s-note'>" +
                    "</span> Delete</button>" +
                    "</td>" +
                    "</tr>");
            }
        },
    });
    $('#name').val('');
});
