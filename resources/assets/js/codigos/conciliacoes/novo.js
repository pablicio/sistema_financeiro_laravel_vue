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