$(document).ready(function () {

    function soNumeros(numeros) { //variavel do parametro recebe o caractere digitado//
        return numeros.replace(/\D/g, "");
    }

    function retiraValores(classe) {

        var soma = 0;

        $(document).find(classe).each(function (el, field) {
            soma += +soNumeros(field.value);
        });

        return soma;
    }


    function somarValores(classe) {

        var soma = 0;

        quantidades = [];

        $(document).find('.quantidade').each(function (el, field) {
            quantidades.push(field.value);
        });

        cont = 0;

        $(document).find(classe).each(function (el, field) {
            soma += +soNumeros(field.value) * quantidades[cont];
            cont++;
        });

        return soma;
    }

    $(function () {
        $(document).find('.calcular').on('mouseover', function (e) {

            var total = somarValores('.valorcc');

            desconto = soNumeros($('#desconto').val());

            total -= desconto;

            total /= 100;

            $('#valorFormas').val(total);

            $('#valor').val(total);
        })
    });

    $(function () {
        $(document).find('.tirar').on('mouseover', function (e) {

            var total = retiraValores('.valorTira') / 100;

            retira = $('#valor').val();

            total -= retira;

            $('#valorFormas').val(total);

        })
    });

});
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

$(document).ready(function () {
    var campos_max = 15;   //max de 15 campos
    var x = 1; // campos iniciais
    var data;
    $('#addCampoDebito').click(function (e) {
        e.preventDefault();     //prevenir novos clicks
        $.ajax({
            url: "/getFormasPgto",
            type: "GET",
            data: data,
            success: function (result) {
                if (x < campos_max) {
                    cartoes = '<select class="form-control" name="cartao_debito'+x+'[cartao_id]">' +
                        '<option selected="selected" value="">' +
                        '*** CARTÃO ***' +
                        '</option>';

                    for (i = 0; i < result.cartoes.length; i++) {
                        cartoes += '<option value=' + result.cartoes[i].id + '>' + result.cartoes[i].nome + '</option>';
                    }

                    $('#camposDebito').append('<div class="row">'+
                        '<div class="col-lg-1">'+
                        '</div>'+
                        '<div class="col-lg-2">' +
                            cartoes +'</select>'+
                        '</div>' +
                        '<div class="col-lg-2">' +
                        '<input class="form-control" type="text" name="cartao_debito'+x+'[total_parcelas]" placeholder="Total de Parcelas">' +
                        '</div>' +
                        '<div class="col-lg-2">' +
                        '<input class="form-control" type="text" name="cartao_debito'+x+'[data_vencimento]" placeholder="Data de Vencimento">' +
                        '</div>' +
                        '<div class="col-lg-2">' +
                        '<input class="form-control" type="text" name="cartao_debito'+x+'[data_pagamento]" placeholder="Data de Pagamento">' +
                        '</div>' +
                        '<div class="col-lg-2">' +
                        '<input class="form-control valorTira money" type="text" name="cartao_debito'+x+'[valor]" placeholder="Valor">' +
                        '</div>' +
                        '<input type="hidden" name="cartao_debito'+x+'[forma_de_pagamento_id]" value="3">'+
                        '<a href="#" class="del_campo btn btn-danger">x</a><br>' +
                        '</div>');
                    x++;
                }
            }
        });

    });

    // Remover o div anterior
    $('#camposDebito').on("click", ".del_campo", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
});

/**
 * Created by pabliciotjg on 10/08/2017.
 */
$(document).ready(function () {
    var max_fields = 30;   //max de 15 inscricoes de cada vez
    var x = $('#total_campos_produto').val();

    var data;
    $('#add_field_produto').click(function (e) {

        e.preventDefault();     //prevenir novos clicks
        $.ajax({
            url: "/getData",
            type: "GET",
            data: data,
            success: function (result) {
                if (x < max_fields) {

                    produtos = '<select class="form-control" name="produto-' + x + '[id]">' +
                        '<option selected="selected" disabled="disabled" hidden="hidden" value="">' +
                        '                       *** Selecione o Produto ***' +
                        '</option>';

                    for (i = 0; i < result.produtos.length; i++) {
                        produtos += '<option value=' + result.produtos[i].id + '>' + result.produtos[i].nome + '</option>';
                    }

                    $('#listasProdutos').append('<tr class="remove' + x + '">' +
                        '<td>' +
                        produtos +
                        '</td>' +
                        '<td>' +
                        '<input class="form-control quantidade" value="1" type="text" name="produto-' + x + '[quantidade]"  placeholder="Quantidate">' +
                        '</td>' +
                        '<td>' +
                        '<input class="form-control valorcc money" type="text" name="produto-' + x + '[valor]" placeholder="Valor">' +
                        '</td>' +
                        '<td>' +
                        '<a href="#" class="remove_campo btn btn-danger" value="zeta" id="remove' + x + '">x</a>' +
                        '</td>');
                    x++;
                }

            }
        });

    });


    $('#listasProdutos').on("click", ".remove_campo", function (e) {
        e.preventDefault();
        var tr = $(this).attr('id');
        var id = $(this).attr('value');

        if (id == "zeta") {
            swal("Excluído!", "O serviço foi excluído com sucesso.", "success");
        } else {
            e.preventDefault();
            $.ajax({
                url: '/vendas/deleteItem',
                type: 'get',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id
                },
                success: function (response) {

                    swal("Excluído!", "O produto foi excluído com sucesso.", "success");

                }, error: function () {
                    swal("Erro!", "Não foi possível remover o produto.", "error");
                }
            });
        }
        $('#listasProdutos tr.' + tr).remove();
        x--;
    });

});


/**
 * Created by pabliciotjg on 10/08/2017.
 */
$(document).ready(function () {
    var max_fields = 30;   //max de 15 inscricoes de cada vez
    var x = $('#total_campos_servico').val();

    var data;
    $('#add_field_servico').click(function (e) {
        e.preventDefault();     //prevenir novos clicks
        $.ajax({
            url: "/getData",
            type: "GET",
            data: data,
            success: function (result) {
                if (x < max_fields) {
                    servicos = '<select class="form-control" name="servico-' + x + '[id]">' +
                        '<option selected="selected" disabled="disabled" hidden="hidden" value="">' +
                        '                       *** Selecione o Servico ***' +
                        '</option>';

                    for (i = 0; i < result.servicos.length; i++) {
                        servicos += '<option value=' + result.servicos[i].id + '>' + result.servicos[i].nome + '</option>';
                    }

                    $('#listasServicos').append('<tr class="remove' + x + '">' +
                        '<td>' +
                        servicos +
                        '</td>' +
                        '<td>' +
                        '<input class="form-control quantidade" value="1" type="text" name="servico-' + x + '[quantidade]" id="dta_nasc" placeholder="Quantidate">' +
                        '</td>' +
                        '<td>' +
                        '<input class="form-control valorcc money" type="text" name="servico-' + x + '[valor]" id="dta_nasc" placeholder="Valor">' +
                        '</td>' +
                        '<td>' +
                        '<a href="#" class="remove_campo btn btn-danger" value="zeta" id="remove' + x + '">x</a>' +
                        '</td>');
                    x++;
                }

            }
        });

    });


    $('#listasServicos').on("click", ".remove_campo", function (e) {
        e.preventDefault();
        var tr = $(this).attr('id');

        var id = $(this).attr('value');

        if (id == "zeta") {
            swal("Excluído!", "O serviço foi excluído com sucesso.", "success");
        } else {
            e.preventDefault();
            $.ajax({
                url: '/vendas/deleteItem',
                type: 'get',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id
                },
                success: function () {

                    swal("Excluído!", "O serviço foi excluído com sucesso.", "success");

                }, error: function () {
                    swal("Erro!", "Não foi possível remover o serviço.", "error");
                }
            });
        }
        $('#listasServicos tr.' + tr).remove();
        x--;
    });

});




/**
 * Created by Lais on 20/08/2017.
 */
$(document).ready(function () {
    $(document).find('.tirar').on('mouseover', function () {

        if($('.vdinheiro').val() == '' || $('.vdinheiro').val() == 'R$ 0,00'){
            $('.pdinheiro').prop('required',false);
            $('.vdinheiro').prop('required',false);


        }else {
            $('.pdinheiro').prop('required',true);
            $('.vdinheiro').prop('required',true);

        }

        if($('.vcartaoCredito').val() == '' || $('.vcartaoCredito').val() == 'R$ 0,00'){
            $('.vcartaoCredito').prop('required',false);
            $('.pcartaoCredito').prop('required',false);
        }else {
            $('.vcartaoCredito').prop('required',true);
            $('.pcartaoCredito').prop('required',true);
        }

        if($('.vcartaoDebito').val() == '' || $('.vcartaoDebito').val() == 'R$ 0,00'){
            $('.vcartaoDebito').prop('required',false);
            $('.pcartaoDebito').prop('required',false);
        }else {
            $('.vcartaoDebito').prop('required',true);
            $('.pcartaoDebito').prop('required',true);
        }

        if($('.vboleto').val() == '' || $('.vboleto').val() == 'R$ 0,00'){
            $('.vboleto').prop('required',false);
            $('.pboleto').prop('required',false);
        }else {
            $('.vboleto').prop('required',true);
            $('.pboleto').prop('required',true);
        }

        if($('.vcheque').val() == '' || $('.vcheque').val() == 'R$ 0,00'){
            $('.vcheque').prop('required',false);
            $('.pcheque').prop('required',false);
        }else {
            $('.vcheque').prop('required',true);
            $('.pcheque').prop('required',true);
        }

        if($('.voutra').val() == '' || $('.voutra').val() == 'R$ 0,00'){
            $('.voutra').prop('required',false);
            $('.poutra').prop('required',false);
        }else {
            $('.voutra').prop('required',true);
            $('.poutra').prop('required',true);
        }
    })
});
//# sourceMappingURL=vendas.js.map
