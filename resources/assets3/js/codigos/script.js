$(document).ready(function () {
    $('.dropdown-toggle').dropdown();
});


$('select[name=estado]').change(function () {
    var idEstado = $(this).val();
    $.get('/get-cidades/' + idEstado, function (cidades) {
        $('select[name=cidade_id]').empty();
        $.each(cidades, function (key, value) {
            $('select[name=cidade_id]').append('<option value=' + value.id + '>' + value.nome + '</option>');
        });
    });
});


//SELECT DE SUBTIPOS DE PAGAMENTOS
$(document).on('change', '.pgto', function () {

    id = $(this).val();

    $.ajax({
        url: "/getSubTiposPagamentos/"+id,
        type: "GET",
        success: function (result) {

            $('.subpgto').empty();
            $.each(result, function (key, value) {

                $('.subpgto').append('<option value=' + value.id + '>' + value.descricao + '</option>');
            });

        }
    });
});

function datePiker() {

$('input[name="data_inicial"]').daterangepicker(
    {
        autoUpdateInput: false,
        locale: {
            format: 'DD/MM/YYYY HH:mm',
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

        }
    })
    .on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY HH:mm') + ' - ' + picker.endDate.format('DD/MM/YYYY HH:mm'));
    })
    .on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });


$('.date').daterangepicker({
        timePicker: false,
        singleDatePicker: true,
        autoUpdateInput: false,
        locale: {
            format: 'DD/MM/YYYY HH:mm',
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

        }
    })
    .on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY'));
    })
    .on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
}


datePiker();

