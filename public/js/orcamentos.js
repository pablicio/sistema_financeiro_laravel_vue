$(document).ready(function () {

    function soNumeros(numeros) { //variavel do parametro recebe o caractere digitado//
        return numeros.replace(/\D/g, "");
    }

    function somarValores(classe) {

        var soma = 0;

        quantidades = [];

        $(document).find('.quantidade').each(function (el, field) {
            quantidades.push(field.value);
        });

        console.log(quantidades);

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

                    produtos = '<select class="select2" name="produto-' + x + '[id]">' +
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

                $(".select2").select2();

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
                url: '/orcamentos/deleteItem',
                type: 'get',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id
                },
                success: function (response) {
                    console.log(response)

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
                    servicos = '<select class="select2" name="servico-' + x + '[id]">' +
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
                        '<input class="form-control quantidade" value="1"  type="text" name="servico-' + x + '[quantidade]" id="dta_nasc" placeholder="Quantidate">' +
                        '</td>' +
                        '<td>' +
                        '<input class="form-control valorcc money" type="text" name="servico-' + x + '[valor]" id="dta_nasc" placeholder="Valor">' +
                        '</td>' +
                        '<td>' +
                        '<a href="#" class="remove_campo btn btn-danger" value="zeta" id="remove' + x + '">x</a>' +
                        '</td>');
                    x++;
                }

                $(".select2").select2();
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
                url: '/orcamentos/deleteItem',
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




//# sourceMappingURL=orcamentos.js.map
