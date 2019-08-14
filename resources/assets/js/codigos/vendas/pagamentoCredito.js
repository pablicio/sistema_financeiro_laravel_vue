$(document).ready(function () {
    var campos_max = 15;   //max de 15 campos
    var x = 1; // campos iniciais
    var data;
    $('#addCampoCredito').click(function (e) {
        e.preventDefault();     //prevenir novos clicks
        $.ajax({
            url: "/getFormasPgto",
            type: "GET",
            data: data,
            success: function (result) {
                if (x < campos_max) {
                    cartoes = '<select class="form-control" name="cartao_credito'+x+'[cartao_id]">' +
                        '<option selected="selected" value="">' +
                        '*** CARTÃO ***' +
                        '</option>';

                    for (i = 0; i < result.cartoes.length; i++) {
                        cartoes += '<option value=' + result.cartoes[i].id + '>' + result.cartoes[i].nome + '</option>';
                    }

                    $('#camposCredito').append('<div class="row">'+
                        '<div class="col-lg-1">'+
                        '</div>'+
                        '<div class="col-lg-2">' +
                            cartoes +'</select>'+
                        '</div>' +
                        '<div class="col-lg-2">' +
                        '<input class="form-control" type="text" name="cartao_credito'+x+'[total_parcelas]" placeholder="Total de Parcelas">' +
                        '</div>' +
                        '<div class="col-lg-2">' +
                        '<input class="form-control" type="text" name="cartao_credito'+x+'[data_vencimento]" placeholder="Data de Vencimento">' +
                        '</div>' +
                        '<div class="col-lg-2">' +
                        '<input class="form-control" type="text" name="cartao_credito'+x+'[data_pagamento]" placeholder="Data de Pagamento">' +
                        '</div>' +
                        '<div class="col-lg-2">' +
                        '<input class="form-control valorTira money" type="text" name="cartao_credito'+x+'[valor]" placeholder="Valor">' +
                        '</div>' +
                        '<input type="hidden" name="cartao_credito'+x+'[forma_de_pagamento_id]" value="2">'+
                        '<a href="#" class="del_campo btn btn-danger">x</a><br>' +
                        '</div>');
                    x++;
                }
            }
        });

    });

    // Remover o div anterior
    $('#camposCredito').on("click", ".del_campo", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
});
