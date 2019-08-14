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

