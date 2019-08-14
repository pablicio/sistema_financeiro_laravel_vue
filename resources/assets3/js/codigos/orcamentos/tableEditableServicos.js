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



