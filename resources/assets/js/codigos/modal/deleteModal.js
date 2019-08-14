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