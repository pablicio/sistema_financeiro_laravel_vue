/**
 * Created by pabliciotjg on 10/09/2017.
 */

function datatableRelatorio() {


$(function () {
    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Busca:</span> _INPUT_',
            lengthMenu: '<span>Mostrar:</span> _MENU_',
            paginate: {'first': 'Primeiro', 'last': 'Último', 'next': '&rarr;', 'previous': '&larr;'},
            sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            sZeroRecords: "Nenhum registro encontrado",
            sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
            sEmptyTable: "Nenhum registro encontrado",
        }
    });

    $('.datatable-export').DataTable({
        paginate: false,
        buttons: {
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="icon-copy3 position-left"></i> Copiar',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="icon-file-excel position-left"></i> Excel',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="icon-file-pdf position-left"></i> PDF',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        }
    });
});

}