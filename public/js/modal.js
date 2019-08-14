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

$(document).on('click', '.delete-modal', function() {
    $('#footer_action_button').text("Excluir");
    $('#footer_action_button').removeClass('btn btn-info');
    $('#footer_action_button').addClass('btn btn-danger');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('delete');
    $('.modal-title').text('Delete');
    $('.did').val($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('.dname').html($(this).data('name'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.delete', function() {
    $.ajax({
        type: 'post',
        url: '/deleteItem',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('.did').val()
        },
        success: function(data) {
            $('.item' + $('.did').val()).remove();
        }
    });
});
$(document).on('click', '.edit-modal', function () {
    $('#footer_action_button').text("Editar");
    $('#footer_action_button').addClass('btn btn-info');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').addClass('edit');
    $('.modal-title').text('Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#n').val($(this).data('name'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.edit', function () {

    $.ajax({
        type: 'post',
        url: '/editItem',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $("#fid").val(),
            'descricao': $('#n').val()
        },
        success: function (data) {
            $('.item' + data.id).
            replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.descricao + "</td>" +
                "<td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.descricao + "'>" +
                "<span class='pe-7s-note'></span> Edit</button>" +
                " <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.descricao + "' >" +
                "<span class='pe-7s-note'></span> Delete</button></td></tr>");
        }
    });
});
//# sourceMappingURL=modal.js.map
