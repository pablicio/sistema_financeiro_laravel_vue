/**
 * Created by pabliciotjg on 01/09/2017.
 */


//Inicializa o modal de criação de lançamentos
$(document).on('click', '.criarNovo', function () {

    valor = $(this).attr('value');

    valor >= 0 ? slug = 'Recebimento' : slug = 'Pagamento';

    $('.modal-title').text('Gerar Lançamentos de ' + slug);

    $('#myModalNovo' + slug).modal('show');

    idDiv = $(this).attr('id');

    $('.id_div').val(idDiv);

});

//AQUI TA DANDO AQUELE BUG DOIDO
$(document).ready(function () {

    idDiv = $('#id_session').val();

    if (isset(idDiv)) {

        idConta = $('#lancamento_id').val();

        tipoLancamento = $('#tipoLancamento').val();

        seletor = '#conciliacao_' + idDiv;

        if (tipoLancamento == "pagamento") {

            lancadosPagamentoSelected(idConta, seletor)

        } else if (tipoLancamento == "recebimento") {

            lancadosRecebimentoSelected(idConta, seletor)

        }
    }


});

function lancadosPagamentoSelected(id, seletor) {

    $.ajax({
        url: "/conciliacoes/lancadosPagamentoSelected",
        type: "post",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id
        },
        success: function (result) {


            var div = "<div><a href='#' class='remover_campoPagamento btn-sm btn-danger' " +
                "style='border-radius: 50%;margin-left: 200px;' id='" + result.id + "'>x</a>" +
                "<ul class='list list-unstyled'>" +
                "<li>ID#: " + result.id + "</li>" +
                "<li>Valor: " + (-result.valor) + "</li>" +
                "<li>Descrição: " + result.descricao + "</li>" +
                "<li>Data: <span class='text-semibold'>" + result.data_pagamento + "</span>" +
                "</li>" +
                "</ul>" +
                "</div>" +
                "<input type='hidden' name='contas[]' value= '" + result.id + "'>";

            $(seletor).append(div);
        }

    });
}

function lancadosRecebimentoSelected(id, seletor) {

    $.ajax({
        url: "/conciliacoes/lancadosRecebimentoSelected",
        type: "post",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id
        },
        success: function (result) {

            var div = "<div><a href='#' class='remover_campoRecebimento btn-sm btn-danger' " +
                "style='border-radius: 50%;margin-left: 200px;' id='" + result.id + "'>x</a>" +
                "<ul class='list list-unstyled'>" +
                "<li>ID#: " + result.id + "</li>" +
                "<li>Valor: " + (result.valor) + "</li>" +
                "<li>Descrição: " + result.descricao + "</li>" +
                "<li>Data: <span class='text-semibold'>" + result.data_pagamento + "</span>" +
                "</li>" +
                "</ul>" +
                "</div>" +
                "<input type='hidden' name='contas[]' value= '" + result.id + "'>";


            $(seletor).append(div);
        }

    });
}


function isset(variable) {
    return typeof variable !== typeof undefined ? true : false;
}
/**
 * Created by pabliciotjg on 01/09/2017.
 */

//Inicializa o modal de pesuisa
$(document).on('click', '.pesquisar', function () {

    valor = $(this).attr('value');

    valor >= 0 ? slug = 'Recebimento' : slug = 'Pagamento';

    $('.actionBtn').addClass('pesquisa');
    $('.modal-title').text('Pesquisa de Lançamentos');
    $('#myModal' + slug).modal('show');

    idDiv = $(this).attr('id');
});

//Inicializa os dois modais de pagamento e recebimento
$(document).ready(function () {
    tabela('Recebimento');
    tabela('Pagamento')
});

//Monta o datatable com os resultados de pesquisa de contas a pagar ou receber..
function tabela(slug) {

    //Testa se é negativo ou positivo p/ listar as contas a pagar e receber

    oTable = $('#lancamento' + slug).DataTable({
        autoWidth: false,
        columnDefs: [{
            orderable: false,
            width: '200px',
            targets: [1]
        }],
        language: {
            dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            search: '<span>Busca:</span> _INPUT_',
            lengthMenu: 'Mostrar: _MENU_',
            paginate: {'first': 'Primeiro', 'last': 'Último', 'next': '&rarr;', 'previous': '&larr;'},
            sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            sZeroRecords: "Nenhum registro encontrado",
            sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
            sEmptyTable: "Nenhum registro encontrado",
        },
        "processing": true,
        "serverSide": true,
        "type": "get",
        "ajax": "/conciliacoes/lancados" + slug,
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'data_pagamento', name: 'data_pagamento'},
            {data: 'valor', name: 'valor'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
}

//Esta função é um tanto complexa: 1° quando um usuário clica em pesquisar,
//ela catura o id da conciliação que está no bd e vai no back procurar a conta a pagar ou receber
//após a consulta ela adiciona os dados da conta na div da conciliação além de um hidden com o id da conta pesquisada
$('#lancamentoPagamento').on("click", ".btnPesquisarPagamento", function (e) {

    e.preventDefault();

    id = $(this).attr('value');

    $.ajax({
        url: "/conciliacoes/lancadosPagamentoSelected",
        type: "post",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id
        },
        success: function (result) {

            var seletor = '#conciliacao_' + idDiv;

            //IMPORTANTE!!!!!
            var idRow = '#Pagamento'+result.id;

            $(idRow).hide();

            var div = "<div><a href='#' class='remover_campoPagamento btn-sm btn-danger' " +
                "style='border-radius: 50%;margin-left: 200px;' id='" + result.id + "'>x</a>" +
                "<ul class='list list-unstyled'>" +
                "<li>ID#: " + result.id + "</li>" +
                "<li>Valor: " + (-result.valor) + "</li>" +
                "<li>Descrição: " + result.descricao + "</li>" +
                "<li>Data: <span class='text-semibold'>" + result.data_pagamento + "</span>" +
                "</li>" +
                "</ul>" +
                "</div>" +
                "<input type='hidden' name='contas[]' value= '" + result.id + "'>";

            $(seletor).append(div);
        }

    });
});

$('#lancamentoRecebimento').on("click", ".btnPesquisarRecebimento", function (e) {

    e.preventDefault();

    id = $(this).attr('value');

    $.ajax({
        url: "/conciliacoes/lancadosRecebimentoSelected",
        type: "post",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id
        },
        success: function (result) {

            var seletor = '#conciliacao_' + idDiv;

            //IMPORTANTE!!!!!
            var idRow = '#Recebimento'+result.id;

            $(idRow).hide();

            var div = "<div><a href='#' class='remover_campoRecebimento btn-sm btn-danger' " +
                "style='border-radius: 50%;margin-left: 200px;' id='" + result.id + "'>x</a>" +
                "<ul class='list list-unstyled'>" +
                "<li>ID#: " + result.id + "</li>" +
                "<li>Valor: " + (result.valor) + "</li>" +
                "<li>Descrição: " + result.descricao + "</li>" +
                "<li>Data: <span class='text-semibold'>" + result.data_pagamento + "</span>" +
                "</li>" +
                "</ul>" +
                "</div>" +
                "<input type='hidden' name='contas[]' value= '" + result.id + "'>";

            $(seletor).append(div);
        }

    });
});

//Remove as contas que foram adicionadas e seus hiddens de id

$(document).on("click", ".remover_campoRecebimento", function (e) {

    e.preventDefault();

    var idRow = '#Recebimento'+$(this).children('a').context.id;

    $(idRow).show();

    $(this).parent('div').remove();
});


$(document).on("click", ".remover_campoPagamento", function (e) {

    e.preventDefault();

    var idRow = '#Pagamento'+$(this).children('a').context.id;

    $(idRow).show();

    $(this).parent('div').remove();
});

//# sourceMappingURL=conciliacoes.js.map
